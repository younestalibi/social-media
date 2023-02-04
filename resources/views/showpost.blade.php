@extends('layouts.app')

@section('content')



<div class="row w-75 m-auto border ">
    <div class="col-6">
        <div>

        </div>
        <div class='p-2'>
            <img class='w-100' src="/storage/{{$post->post}}" alt="post">
        </div>
    </div>
    <div class="col-6">
        <div class="pt-4">
            <img class="rounded-circle border border-dark " width='40'height='40'  src="/storage/{{$post->user->profile->image}}"data-holder-rendered="true">
            <b class='px-3'>{{$post->user->user_name}}</b>
        </div>
        <hr>
        <div class="d-flex">
            <img class="rounded-circle border border-dark " width='40'height='40'  src="/storage/{{$post->user->profile->image}}"data-holder-rendered="true">
            <div class='mt-2'><b class='px-3'>{{$post->user->user_name}}</b>{{$post->description}}</div>
        </div>
        <div class='mx-5'>{{$post->created_at}}</div>
        
    </div>
</div>













@endsection
