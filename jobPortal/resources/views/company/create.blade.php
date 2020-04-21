@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
                <img src="{{asset('avatar/serwman1.jpg')}}" alt="company logo" width="100" style="width: 100%;">
            @else 
                <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" alt="Company logo" width="100" style="width:100%">
            @endif
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    Update Logo   
                </div>
                <div class="card-body">
                    <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="company_logo" class="form-control">
                        <br>
                        <button class="btn btn-dark float-right" type="submit">Update</button>
                        @if($errors->has('avatar'))
                        <div class="error" style="color:red;">
                            {{$errors->first('avatar')}}
                        </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Update You Company Information
                </div>
                <div class="card-body">
                    <form action="{{route('company.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="{{Auth::user()->company->address}}" class="form-control">
                        </div>     
                        
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="{{Auth::user()->company->phone}}" class="form-control">
                        </div>     

                        <div class="form-group">
                            <label for="">Website</label>
                            <input type="text" name="website" value="{{Auth::user()->company->website}}" class="form-control">
                        </div>     

                        <div class="form-group">
                            <label for="">Slogan</label>
                            <input type="text" name="slogan" value="{{Auth::user()->company->slogan}}"class="form-control">
                        </div>     

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control">{{Auth::user()->company->description}}</textarea>
                        </div>     
                       
                        <div class="form-group">
                            <button class="btn btn-dark" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    About Your Company
                </div>
                <div class="card-body">
                    <p>Name:{{Auth::user()->company->cname}}</p>
                    <p>Address:{{Auth::user()->company->address}}</p>
                    <p>Phone:{{Auth::user()->company->phone}}</p>
                    <p>Website: 
                        <a href="{{Auth::user()->company->website}}">
                            {{Auth::user()->company->website}}
                        </a>
                    </p>
                    <p>Slogan:{{Auth::user()->company->slogan}}</p>
                    <p>Company Page:<a href="company/{{Auth::user()->company->slug}}">View</a></p>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    Update Cover Photo
                </div>
                <div class="card-body">
                    <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover_photo" class="form-control">
                        <br>
                        <button class="btn btn-dark float-right" type="submit">Update</button>
                        @if($errors->has('cover_photo'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('cover_photo')}}
                                </div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
