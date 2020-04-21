@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Recent Jobs</h1>
        <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ( $jobs as $job )
                    <tr>
                        <td>
                            {{-- if you use asset() it targers to the public folder --}}
                            <img src="{{asset('avatar/serwman1.jpg')}}" width="80" alt="avatar image">
                        </td>
                        <td>
                            Position:{{$job->position}}
                            <br>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}
                        </td>
                        <td> 
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            &nbsp;Address:{{$job->address}}
                        </td>
                        <td>
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            &nbsp;Date:{{$job->created_at->diffForHumans()}}
                        </td>
                        <td>
                            <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                <button class="btn btn-success btn-sm">Apply</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
<style>
    .fa{
        color: #4183D7;
    }
</style>
