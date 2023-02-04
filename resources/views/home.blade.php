@extends('layouts.app')
@section('content')


<div >
<div class="row justify-content-center" >

    <!-- left side -->
    <div class="col d-lg-block d-none"></div>
    <!-- left side -->

    <!-- center left side -->
    <div style='width:500px !important' id='posts' class="col-lg-4 col-md-5 col-sm-6 col-xs">
        <!-- welcome message -->
        @if(count($posts) == 0)
            <div class='h-100 text-center justify-content-center flex-column d-flex w-75 m-auto'>
                <i class="bi bi-emoji-smile" style='font-size:70px;'></i>
                <h1><b>welcome to MDB socaity</b></h1> 
                <h3>seems there is to nothing watch</h3>
                <b>try to find some friends to follow  <a class='text-primary' href="#">here</a></b>
            </div>
        @endif
        <!-- welcome message -->

        @foreach($posts as $post) 
        <div class='bg-white border rounded my-4'>
            <div class='d-flex align-items-center px-3 my-1'>
                <img style='object-fit: cover;' class='rounded-circle border border-dark' width='40' height='40' src="/storage/{{$post->user->profile->image}}" alt="post">
                <b class='m-3'><a href="/profile/{{$post->user->id}}">{{$post->user->user_name}}</a></b>
            </div>
            <div class='px-3'>
                <p>{{$post->description}}</p>
            </div>
            <div>
                <img class='w-100 ' description='{{$post->description}}' post_id='{{$post->id}}' src="/storage/{{$post->post}}" alt="post"  >
            </div>
            <div class='px-3 pt-2'>
                <div>
                    @if($post->likes->where('user_id',$user->id)->count() == 1)
                    <span style='cursor: pointer' class='click_like text-danger' post_id='{{$post->id}}'><i class="bi bi-heart-fill icon-size"></i></span>
                    @else
                    <span style='cursor: pointer' class='click_like' post_id='{{$post->id}}'><i class="bi bi-heart icon-size"></i></span>
                    @endif
                    <span style='cursor: pointer' class='click_post' description='{{$post->description}}' post_id='{{$post->id}}' src="/storage/{{$post->post}}"><i class="bi bi-chat icon-size mx-3"></i></span>
                </div>
            </div>
            <div class='px-3'>
                <strong><span class='likes_count' post_id='{{$post->id}}'>{{$post->likes->count()}} Likes</span></strong>
            </div>
            @if($post->comments->count()>0)
            <div class='px-3'>
                <span class='text-muted show_comments click_post' style='cursor: pointer' description='{{$post->description}}' post_id='{{$post->id}}' src="/storage/{{$post->post}}">view all {{$post->comments->count()}} comments</span>
            </div>
            @endif
            <div class='px-3'>
                <small class='text-muted'>{{$post->created_at}} Days ago</small>
            </div>
            <div>
                <div class='d-flex align-items-center border-top p-1' class='contain'>
                    <input type="text" id="comment" class='comment outline-success border-0 w-75 mx-3 form-control ' placeholder='Add a comment' >
                    <b class=' text-primary posting' style='cursor: pointer'  post_id='{{$post->id}}'>Post</b>
                </div>
            </div>

            <!-- pop up the post --> 
            <div post_id='{{$post->id}}'  class="modal align-self-center justify-content-center" >
                <div class="modal-content  h-100">
                    <span onclick="closing()"  class="close" title="Close Modal">&times;</span>
                    <div class="row cc ">
                        <div class='col h-100 cc bg-dark'>
                            <div class='image'>
                            </div>
                        </div>
                        <div class="col-5">
                            <div>
                                <img style='object-fit: cover;' src="/storage/{{$post->user->profile->image}}" id='img_post' alt="ff">
                                <b>{{$post->user->user_name}}</b>
                            </div>
                            <hr>
                            <div>
                                <img style='object-fit: cover;' src="/storage/{{$post->user->profile->image}}" id='img_post' alt="ff">
                                <b>{{$post->user->user_name}} </b>
                                <div class='d-inline' id='description'> </div>
                            </div>
                            <br>
                                <div  class='m-1 comments' style='overflow: auto; height:257px !important'>
                            </div>
                            <div class="d-flex justify-content-around w-50 my-2">
                                <div class='likes_count'>likes</div>
                            </div>
                            <div class='d-flex align-items-center ' class='contain'>
                                <input type="text" id="comment" class='comment border-0 w-75 mx-3 form-control ' placeholder='Add a comment' >
                                <b class=' text-primary posting' style='cursor: pointer'  post_id='{{$post->id}}'>Post</b>
                            </div>
                            
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- center left side -->

    <!-- center right side -->
    <div class="col-lg-3 p-4 d-lg-block d-none mt-5" >
        <div class="row ">
            <div class='d-flex justify-content-between align-items-center'>
                <div class="d-flex align-items-center">
                    <img style='object-fit: cover;' class='rounded-circle border border-dark ' width='60' height='60' src="/storage/{{auth()->user()->profile->image}}" alt="post">
                    <div class='mx-3 line_hight'>
                        <b ><a href="/profile/{{auth()->user()->id}}">{{auth()->user()->name}}</a></b>
                        <div><a href="/profile/{{auth()->user()->id}}" class='text-muted '>{{'@'.auth()->user()->user_name}}</a></div>
                    </div>
                </div>
                <b class="text-primary" style='cursor: pointer'><small>Switch</small></b>
            </div>
        </div>

        
        <div class="row my-3">
            <div class="d-flex justify-content-between">
                <b><small class="text-muted">Suggestions For You</small></b>
                <b style='cursor: pointer'><small>See All</small></b>
            </div>            
        </div>

        <!-- suggesting other users -->
        

        <div class="row " style='overflow: auto; height:150px !important'>
            @foreach($users as $user)
                @if (!$follower->contains($user->profile))
                    <div>
                    <div class='suggests_container d-flex align-items-center justify-content-between'>
                        <div class='d-flex align-items-center'>
                            <img src='/storage/{{auth()->user()->profile->image}}' alt="post" class="rounded-circle border border-dark mt-2" height="50" width='50' style='object-fit:cover;'  style='border:2px solid black !important'/>
                            <div class='d-flex flex-column mx-2 line_hight'>
                                <b ><a href="/profile/{{$user->id}}">{{$user->name}}</a></b>
                                <small class='text-muted'><a href="/profile/{{$user->id}}">{{'@'.$user->user_name}}</a></small>
                            </div>
                        </div>
                        <div>
                            <div class='border-0 text-primary btn_follow_in_home'  user='{{$user->id}}' style='cursor: pointer'><b>Follow</b></div>
                        </div>
                    </div>
                    </div>
                @else 
                @endif
            @endforeach
        </div>

        <div class="row ">
            <div class="text-muted justify-content-start d-flex">
                    <b><small >About</small></b>
                    <b><small class='mx-2'>Help</small></b>
                    <b><small >Language</small></b>
            </div>
        </div>
        <div class="row ">
            <div class="col  text-muted">
                <b><small>© 2022 INSTAGRAM FROM | | YOUNES_TALIBI</small></b>
            </div>
        </div>

    </div>
    <!-- center right side -->

    <!-- right side -->
    <div class="col d-lg-block d-none"></div>
    <!-- right side -->

@endsection