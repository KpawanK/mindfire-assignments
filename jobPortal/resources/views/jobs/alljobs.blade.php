@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Since the method is get so all data will be placed in url --}}
        <form action="{{route('alljobs')}}" method="GET">
        <div class="form-inline">
            <div class="form-group">
                <label>Keyword&nbsp;</label>
                <input type="text" name="title" class="form-control">&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Employment type&nbsp;</label>
                <select name="type" class="form-control">
                    <option value="">-select-</option>
                    <option value="fulltime">Full-time</option>
                    <option value="parttime">Part-time</option>
                    <option value="casual">Casual</option>
                </select>&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Category&nbsp;</label>
                <select name="category_id" class="form-control">
                    <option value="">-select-</option>
                    @foreach ( App\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Address&nbsp;</label>
                <input type="text" name="address" class="form-control">&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success" type="submit">
                    Search
                </button>
            </div>
        </div>
     </form>
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
                            <img src="{{asset('uploads/logo')}}/{{$job->company->logo}}" width="80" alt="avatar image">
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
        {{-- gives the links to move to different pages of paginated data--}}
        {{-- if u have searched data using filters then paginate to another page will refresh the url and we will loose the filters so laravel gives append to make our work easier --}}
        {{-- {{$jobs->links()}} --}}
        {{$jobs->appends(request()->except('page'))->links()}}
    </div>
</div>
@endsection
<style>
    .fa{
        color: #4183D7;
    }
</style>
