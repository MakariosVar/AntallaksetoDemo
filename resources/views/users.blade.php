@extends('layouts.layout')
@section('content')
<div class="container">

        <div class="row">
                <div class="card mb-3 content">
                        <section class="post-list">
                                @foreach($users as $user)
                                <div class="card mt-3 mb-3">
                                        <div class="card-body">
                                                <div class="d-flex justify-content-center">     
                                                         <img src="{{ $user->profile->profileImage()}}" class="rounded-circle" width="150">
                                               </div>

                                               
                                                <div class="mt-3">
                                                        <h3 style=" text-align: center;"><a href="/profile/{{$user->id}}">{{ $user->name}}</a> </h3>
                                                        <div  style=" text-align: center;">Posts: <strong>{{$user->posts->count()}}</strong></div>
                                                        <div  style=" text-align: center;">Followers: <strong>{{$user->profile->followers()->count()}}</strong> </div>
                                                        <div  style=" text-align: center;">Following: <strong>{{$user->following->count()}}</strong> </div>

                                                </div>
                                        </div>
                                </div>
	    	                @endforeach
    	                </section>
                </div>
        </div>
</div>
@endsection
