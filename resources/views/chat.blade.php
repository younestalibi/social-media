@extends('layouts.app')

@section('content')




<div class="row justify-content-center vh-100 " style='position: fixed;width: 100%;' >



    <div class="p-0 col-lg-3 col-md-4 col-sm-5 h-75 border rounded bg-white" style='overflow-y:auto;height:100%;overflow-x: hidden;'  id='list_friends'>
        <div >
            <!-- my profile -->
            <div  class='justify-content-center d-flex  border-bottom p-1 '>
                <img  src='/storage/{{auth()->user()->profile->image}}' alt="post" class="rounded-circle border border-dark" height="32"  width='32' style='object-fit:cover;'/>
            </div>
            <!-- my profile -->
            <!-- friends list section -->
            @foreach(auth()->user()->following as $following)
            <div class='border-bottom'>
                <div class='d-flex p-3 align-items-center friends users' id='{{$following->user->id}}' user='{{auth()->user()->id}}' name='{{$following->user->user_name}}' status='{{$following->user->status}}' image='/storage/{{$following->image}}' style='cursor: pointer'> 
                    <div class='d-flex' style='position: relative;'>
                        <img  src='/storage/{{$following->image}}' alt="profile" class=" rounded-circle border border-dark " height="50" width="50" style='object-fit:cover;'/>

                        @if($following->user->status == 'Offline')
                        <div class='bg-danger rounded-circle status-{{$following->user->id}}' style='width:13px;height:13px;position:absolute;top:35px;right:0px'></div>
                        @elseif($following->user->status == 'Online')
                        <div class='bg-success rounded-circle status-{{$following->user->id}}' style='width:13px;height:13px;position:absolute;top:35px;right:0px'></div>
                        @endif
                        
                    </div>
                    <div class='mx-3'>
                        <b class='users' >{{$following->user->user_name}}</b><br>
                        <b><small class='text-muted user-{{$following->user->id}}'>Is {{$following->user->status}}</small></b>
                    </div>
                    <!-- pending -->
                    @php 
                        $num=DB::table('messages')->where('from', $following->user_id)->where('to', auth()->user()->id)->where('is_read','==',0)->get();
                        if(!$num->count()==0){
                            echo "<b class='bg-primary border mx-5 rounded-circle ' id='pending-{$following->user->id}' user='{{$following->user->id}}' style='width:13px;height:13px;' ></b>";
                        }else{
                            echo "<b class='bg-primary  border d-none mx-5 rounded-circle ' id='pending-{$following->user->id}' user='{{$following->user->id}}' style='width:13px;height:13px;' ></b>";
                        }
                    @endphp
                    <!-- pending -->
                </div>
            </div>
            @endforeach
            <!-- friends list section -->
        </div>

    </div>

    <div class="d-none d-sm-block col-lg-6 col-md-7 h-75 col-sm-7 border rounded bg-white" id='window_chat'>
        <div class='h-100 '>
            <!-- header of chat -->
            <div class='justify-content-end align-items-center d-flex border-bottom p-1 d-none ' id='profile_user_chat'>
                <div class='bg-success rounded-pill px-2 d-none' id='back'><b><-----</b></div>
                <div class='d-flex justify-content-end'>
                    <div class='mx-3'>
                        <b id='username_profile'>name</b><br>
                        <b><small class='text-muted'  id='status_profile'>online</small></b>
                    </div>
                    <img  src='/storage/{{auth()->user()->profile->image}}' alt="post" class="rounded-circle border border-dark" height='50' width='50' style='object-fit:cover;'  />
                </div>
            </div>
            <!-- header of chat -->

            <!-- chat section -->
            <div class='w-100 h-100 my-2 d-none ' id='chat_section'>
                <!-- conversation container -->
                <div class='h-75 px-5 ' id='conversation_container' style='overflow-y:auto;overflow-x:hidden;display: flex;height: 73% !important;flex-direction: column-reverse;'>
                    <!-- <div class="row ">
                        <div class=' w-auto bg-info px-5 py-1 my-2 border  rounded-pill text-wrap' style='max-width: 70%;' >
                            <div >hello how are you doing </div>
                            <div class='d-flex justify-content-start align-items-center text-muted'>
                                <span><i class="bi bi-check2"></i></span>
                                <small style='font-size:11px;'>12:44</small>  
                            </div>  
                        </div>
                    </div>

                    <div class="row justify-content-end ">
                        <div class=' w-auto bg-warning px-5 py-1 my-2 border  rounded-pill text-wrap' style='max-width: 70%;' >
                            <div >hello how are you doing </div>
                            <small style='font-size:11px;'>12:44</small>  
                        </div>
                    </div>
                     -->
                </div>
                <!-- conversation container -->
                 
                <!-- message input -->
                 <div class='mt-2'>
                    <div class='d-flex '>
                        <input type="text" class='form-control' id='message' name='message'>
                        <input type="submit" value="send" id='send_message'  class='btn btn-primary btn-outline-success text-white w-25 form-control'>
                    </div>
                </div>
                <!-- message input -->
            </div>
            <!-- chat section -->

            <!-- welcome section -->
            <div id='chat_window_message' class='h-100 text-center justify-content-center flex-column d-flex w-50 m-auto'>
                <h1>hello world</h1>
                <p>Lorem ipsmus iure, ullam cupiditate.</p>
            </div>
            <!-- welcome section -->

            

            
        </div>
    </div>










</div>






@endsection
