<?php
    class Payments extends Controller{
        public function __construct(){
            require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');
            $this->transactionModel = $this->model('Transaction');
            $this->seatsModel = $this->model('Seat');
        }
        
        //landing view for the payment site
        public function index(){
            $data = [
            ];
            $this->view('payments/index' , $data);   
        } 

        //function to handle the charge section of stripe API
        public function charge(){            
            \Stripe\Stripe::setApiKey('sk_test_cjxjAmrFlQJBZ3aSkQEQxkjQ00pdHLwtjD');

            //Sanitize POST Array
            $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
            $name = $POST['name'];
            $email = $POST['email'];
            $token = $POST['stripeToken'];

            //Create Customer In Stripe
            $customer = \Stripe\Customer::create(array(
                "name" => $name,
                "email" => $email,
                "source" => $token
            ));
            
           
            //Charge Customer
            $charge = \Stripe\Charge::create(array(
                "amount" => $_COOKIE['payableAmount'],
                "currency" => "INR",
                "description" => "Movie Ticket",
                "customer" => $customer->id
            ));


            //Redirect to success page if charge object is returned
            if($charge->status == "succeeded"){
               //Transaction Data
                $transactionData=[
                    "id" => $charge->id,
                    "customer_id" => $_SESSION['user_id'],
                    "product" => $charge->description,
                    "amount" => $charge->amount,
                    "currency" => $charge->currency,
                    "status" => $charge->status,
                ];
                //Call the add Transaction method of Transaction model and insert the transaction 
                $result =  $this->transactionModel->addTransaction($transactionData);
                
                //Store the seats in the database
                $seatsSelected = explode(",",$_COOKIE['seatsSelected']);
                foreach($seatsSelected as $seats){
                    $this->seatsModel->bookSeats($_COOKIE['movie_timing_id'],$_SESSION['user_id'],$seats);  
                }

                //Redirect to the success page 
                $data=[
                    "tid" => $charge->id,
                    "product" => $charge->description,
                ];
                    $this->view('payments/success',$data);
            } else {
               redirect('payments');
           }
        }

        //function to create the qrCode and pdf and mail the ticket to the register user
        public function createPDF(){ 
            //Time to store the pdf and qr code as per time and id
            date_default_timezone_set('Asia/Kolkata');
            $date = date('m-d-Y_h:i:s',time());

            //Generate qrCode 
            $qr = new \Endroid\QrCode\QrCode();
            $qr->setSize(120);
            header('Content-Type: '.$qr->getContentType());
            
            //qrCodePath anf pdfPath
            $qrCodePath = $_SERVER["DOCUMENT_ROOT"].'/public/qrCode/'.$_SESSION['user_id'].'_'.$date.'.png';
            $pdfPath = $_SERVER["DOCUMENT_ROOT"].'/public/ticketPdf/'.$_SESSION['user_id'].'_'.$date.'.pdf';
            
            //store the qrcode
            $qr->writeFile($qrCodePath);

            //Write the pdf content
           $html =  '';
           $html .= '<p style="text-align: center">Booking Conformation</p>
                     <p style="text-align: right"><span style="color: green">&#9742;</span> 022 6144 5050, 022 3989 5050</p>
                     <div style="margin:20px; padding:20px; border:1px solid #595d594d;">
                        <span style="color:green;border:1px solid green;font-size:80px;border-radius:50%;">&#10003;</span>
                        <h3>Thank You for your purchase!</h3>
                        <span>
                            <p>You can access your ticket from your Profile. We will send you an e-mail/SMS/WhatsApp confirmation</p>
                            <p>within 15 minutes.</p>
                        </span>
                    </div>
                    <div style="width: 600px;margin:20px; padding:20px; border:1px solid #595d594d;">
                        <div style="width:400px;float:left;">
                        <h4>'.
                            $_COOKIE['movieSelected']
                        .'(U/A)</h4>
                        <p>'.
                            $_COOKIE['hallSelected']
                        .'<br>'.
                            $_COOKIE['time']
                        .'<br>Quantity:'.
                             $_COOKIE['numberOfSeats']
                        .'<br>Balcony:'.
                            $_COOKIE['seatsSelected']
                        .'</p>
                        <hr style="border-top: dotted 2px;">
                        <span>
                            <span style="text-align:left">Amount Paid</span>
                            <span style="text-align:right">Rs.'.
                                $_COOKIE['payableAmount']
                            .'</span>
                        </span>
                        </div>
                        <div style="float:left;">
                            <img src="'.$qrCodePath.'">
                        </div>
                    </div>';

           //Create pdf and save the file
           $mpdf = new \Mpdf\Mpdf(['tempDir' => $_SERVER["DOCUMENT_ROOT"].'/public/ticketPdf/tempPdfDirectory']);// Create new mPDF Document
           $mpdf->WriteHTML(utf8_encode($html));
           $mpdf->Output($pdfPath, 'F');

           //SEND TICKET AS MAIL TO THE USER WITH THE REGISTERED EMAIL ID
           $subject ='Your Movie Ticket for '.$_COOKIE['movieSelected'].' from OTBS';
           $body = 'Thank You for Purchasing with Us . Hope you Enjoy Movie . Here is the ticket of your booking';
           $to = $_SESSION['user_email'];
           $attachment = $pdfPath;
           $result = send_mail($subject,$body,$to,$attachment);
           if($result){
                redirect('pages');
           } else {
               die('Something went ! Failed to send mail');
           }
           
           
        }
    }
