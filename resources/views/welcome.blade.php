@extends('layouts.app')
@section('content')



<div class='container'>
    <div class="row justify-content-center">
        <div class="col-9 ">
            <div  class="d-flex justify-content-center">
                <img class='rounded-circle' width='100px' height='100px' style='object-fit:cover;' src='/storage/{{$user->profile->image}}' alt="post">
            </div>
            <div class="d-flex justify-content-center " style='font-size:16px'>
                <b >{{'@'.$user->user_name}}</b>
            </div>
            <div class='row justify-content-center mt-2'>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 text-center">
                    <div class='text-muted'>Posts</div>
                    <b>{{$user->post->count()}}</b>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 text-center">
                    <div class='text-muted' id='followers' style='cursor: pointer;' onclick="document.getElementById('id01').style.display='block'">Followers</div>
                    <b>{{$user->profile->followers->count()}}</b>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 text-center">
                    <div class='text-muted' style='cursor: pointer;' onclick="document.getElementById('id02').style.display='block'">Following</div>
                    <b>{{$user->following->count()}}</b>
                </div>
            </div>
            <div class='justify-content-center d-flex row'>
                @can('update',$user->profile)
                <a href="{{route('edite',auth()->user()->id)}}" class="col-md-3 col-sm-4 col-5 btn bg-white rounded-0 text-dark border"><b>Edite profile</b></a>
                @endcan
                @can('view',$user->profile)
                    @if($followers->contains(auth()->user()))
                        <button class='col-md-3 col-sm-4 col-5 btn rounded-0 border border-secondary' id='btn_follow_in_profile' user='{{$user->id}}'>Unfollow</button>
                    @else
                        <button class='col-md-3 col-sm-4 col-5 btn rounded-0 btn-primary' id='btn_follow_in_profile' user='{{$user->id}}'>Follow</button>
                    @endif
                        
                @endcan
            </div>

            <div>
                <div class="row justify-content-center mt-2">
                    <div class="col-md-2 col-sm-3 col-4 text-center ">
                        <button style='font-size:11px' class='border-0 rounded bg-secondary px-1'><b>{{$user->profile->full_name}}</b></button>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class='text-center col-lg-4 col-md-5 col-sm-6 col-7' style='line-height: 14px;'>
                        {{$user->profile->description}}
                        <a href="#" class='text-primary nav-link' style='font-size:12px'><b>{{$user->profile->link}}</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='justify-content-center  d-flex'>
    <div class="row justify-content-start w-100">
        @foreach($user->post as $post)
        <div  class=" col-4 d-flex my-2 justify-content-center p-1">
            <img style="width: 90%;  object-fit: cover;" class='bob bg-success rounded' description='{{$post->description}}' id='{{$post->post}}' com='[{{$post->comments}}]' src="/storage/{{$post->post}}" onclick="showImg(this);"> 
        </div>
        @endforeach   
    </div>

</div>

     <!-- post_is_onclick --> 
<div id="id03" class="modal align-self-center justify-content-center" >
    <div class="modal-content  h-100">
        <span onclick="close();document.getElementById('id03').style.display='none'"  class="close" title="Close Modal">&times;</span>
        <div class="row cc ">
            <div class='col h-100 cc bg-dark'>
                <div class='image'></div>
            </div>
            <div class="col-5">
                <div>
                    <img style='object-fit: cover;' src="/storage/{{$user->profile->image}}" id='img_post' alt="ff">
                    <b>{{$user->user_name}}</b>
                </div>
                <hr>
                <div>
                    <img style='object-fit: cover;' src="/storage/{{$user->profile->image}}" id='img_post' alt="ff">
                    <b>{{$user->user_name}} </b>
                    <div class='d-inline' id='description'> </div>
                </div>
                <br>
                <div id='comm' class='m-1' style='overflow: auto; height:257px !important'>
                </div>
            </div>
        </div>
        
    </div>
</div>
    
    
   


    <!-- followers_button -->
<div id="followers_refresh">
    <div id="id01" class="modal">
        <form class="modal-content "  action="/action_page.php" method="post">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            @foreach($followers as $follower)
            <div class='w-50 m-auto my-2'>
                    <img class='mx-2 align-self-center img-follow border border-dark ' src="/storage/{{$follower->profile->image}}" alt="">        
                    <b>{{$follower->user_name}}</b><br>
            </div>
            @endforeach
        </form>
    </div>
</div>
    
    <!-- following_button -->
<div id="id02" class="modal">
    <div class="modal-content " >
        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        @foreach($following as $follow)
        <div class='w-75 m-auto my-2'>
            <img class='mx-2  align-self-center img-follow border border-dark ' src="/storage/{{$follow->image}}" alt="">
            <b >{{$follow->user->user_name}}</b><br>
        </div>
        @endforeach
    </div>

</div>


<script>
    setInterval(()=>{
        $('.bob').css('height',$('.bob').css('width'))
    },500)
</script>
@endsection

 