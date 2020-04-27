@extends('layouts.main')
@section('content')
<div class="album text-muted">
    <div class="container">
        <div class="row" id="app">
            <div class="title" style="margin-top: 20px;">
                <h2>{{$job->title}}</h2> 
            </div>

            <img src="{{asset('hero-job-image.jpg')}}" style="width: 100%;">
            <div class="col-lg-8">
                <div class="p-4 mb-8 bg-white">
                    <!-- icon-book mr-3-->
                    <h3 class="h5 text-black mb-3"><i class="fa fa-book" style="color: blue;">&nbsp;</i>Description <a href="#"data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-envelope-square" style="font-size: 34px;float:right;color:green;"></i></a></h3>
                    <p> {{$job->description}}.</p>
                </div>
            </div>
        </div>  
    </div>
</div>
<br><br>
@endsection
