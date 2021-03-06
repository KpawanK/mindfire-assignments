@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
                <img src="{{asset('avatar/serwman1.jpg')}}" alt="user avatar" width="100" style="width:100%">
            @else 
                <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}" alt="user avatar" width="100" style="width:100%">
            @endif
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    Update profile picture   
                </div>
                <div class="card-body">
                    <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
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
                    Update You Profile
                </div>
                <div class="card-body">
                    <form action="{{route('profile.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="{{Auth::user()->profile->address}}"  class="form-control">
                            
                            {{-- check if any errors then display error using $error variable which laravel provides--}}
                            @if($errors->has('address'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('address')}}
                                </div>
                            @endif

                        </div>
                        
                        <div class="form-group">
                            <label for="">Phone number</label>
                            <input type="text" name="phone_number" value="{{Auth::user()->profile->phone_number}}"  class="form-control">

                            @if($errors->has('phone_number'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('phone_number')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Experience</label>
                            <textarea name="experience" class="form-control">{{Auth::user()->profile->experience}}</textarea>

                            @if($errors->has('experience'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('experience')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Bio</label>
                            <textarea name="bio" class="form-control">{{Auth::user()->profile->bio}}</textarea>

                            @if($errors->has('bio'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('bio')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
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
                    About You
                </div>
                <div class="card-body">
                    <p>Name:{{Auth::user()->name}}</p>
                    <p>Email:{{Auth::user()->email}}</p>
                    <p>Address:{{Auth::user()->profile->address}}</p>
                    <p>Phone:{{Auth::user()->profile->phone_number}}</p>
                    <p>Gender:{{Auth::user()->profile->gender}}</p>
                    <p>Experience:{{Auth::user()->profile->experience}}</p>
                    <p>Bio:{{Auth::user()->profile->bio}}</p>
                    <p>Member On:{{date('F d Y',strtotime(Auth::user()->created_at))}}</p>
                    @if(!empty(Auth::user()->profile->cover_letter))
                        <p>
                            <a href="{{Storage::url(Auth::user()->profile->cover_letter)}}">
                            Cover Letter
                            </a>
                        </p>
                    @else
                        <p>Please upload your cover letter</p>
                    @endif

                    @if(!empty(Auth::user()->profile->resume))
                        <p>
                            <a href="{{Storage::url(Auth::user()->profile->resume)}}">
                            Resume
                            </a>
                        </p>
                    @else
                        <p>Please upload your resume</p>
                    @endif
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    Update Coverletter
                </div>
                <div class="card-body">
                    <form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover_letter" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('cover_letter'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('cover_letter')}}
                                </div>
                            @endif
                    </form>
                </div>
            </div>
            
            <br>

            <div class="card">
                <div class="card-header">
                    Update Resume   
                </div>
                <div class="card-body">
                    <form action="{{route('resume')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="resume" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('resume'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('resume')}}
                                </div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
