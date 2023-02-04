<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='icon' href='/storage/default/bar_icon.png' type='image/x-icon'>

    <title>{{ config('app.name', 'Instagram') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- style -->
    <link href="/css/main.css" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
    <div id="app w-100" >

    <!-- Navbar -->
    <nav  class="navbar  fixed-top navbar-light bg-white shadow-sm vw-100" >
        <div class="container justify-content-between ">
            <!-- Left elements -->
            <div class="d-flex my-2 my-sm-0">
            <!-- Brand -->
            <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="{{ url('/home') }}">
                <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="20" alt="brand-logo" style="margin-top: 2px" />
            </a>
            </div>
            <!-- Left elements -->

            <!-- Center elements -->
            <ul class="navbar-nav flex-row d-none d-md-flex">

            @auth
            <!-- Search form -->
            <form class="input-group w-auto my-auto d-none d-sm-flex">
                <input type="search" autocomplete="off" class='form-control w-100 rounded text-muted' placeholder='search' name="search" id="search" style="min-width: 125px" />
                <ul style='position:absolute' class='mt-5  list-group'  id='search_resault'></ul> 
            </form>
            <!-- Search form -->
            @endauth
            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link" href="#">
                <span><i class="fas fa-flag fa-lg"></i></span>
                </a>
            </li>
            </ul>
            <!-- Center elements -->
        
            <!-- Right elements -->
            <ul class="navbar-nav flex-row align-items-center">
            <!-- home section -->
            @auth
            <ul class="navbar-nav flex-row mx-3">
                <li class="nav-item">
                    <a href="/home">
                        <i class="icon-size bi bi-house-door"></i>
                    </a>
                </li>
            </ul>           
            @endauth
            <!-- home section -->
            <!-- chat section -->
            @auth
            <ul class="navbar-nav flex-row mx-3">
                <li class="nav-item">
                    <a href="/chat">
                        <i class="icon-size bi bi-send"></i>
                    </a>
                </li>
            </ul>           
            @endauth
            <!-- chat section -->
            <!-- add new post -->
            @auth
            <ul class="navbar-nav mx-3">
                <li class="nav-item">
                    <a href="{{ route('create') }}">
                        <i class="icon-size bi bi-plus-square"></i>
                    </a>
                </li>
            </ul>
            @endauth
            <!-- add new post --> 
            <ul class="navbar-nav flex-row mx-3" >
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                <li class="nav-item dropdown " >
                    <a class="nav-link d-sm-flex align-items-sm-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img  src='/storage/{{auth()->user()->profile->image}}' alt="post" class="rounded-circle border border-dark" height="29" width='29'   style='object-fit:cover;'/>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end p-0" style='position: absolute;' aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="{{ route('profile',auth()->user()->id)}}">
                        <i class="bi bi-person-circle"></i> Profile
                        </a>
                        <a href="{{route('edite',auth()->user()->id)}}" class="dropdown-item">
                        <i class="bi bi-gear"></i> Settings
                        </a>
                        <a class="dropdown-item border-top" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            @endguest  
            </ul>
            <!-- Right elements -->
        </div>
    </nav>
    <!-- Navbar -->

    <main class="py-4" style='margin-top:60px;overflow-x: hidden''>
        @yield('content')
    </main>
        
</div>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="\frameworks\jQurey\Jquery.js"></script>
<script src="/js/main.js"></script>
@auth
    <!-- pusher script -->
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('0fc33308824f759cdafe', {
      cluster: 'eu'
    });
    var channel = pusher.subscribe('{{auth()->user()->id}}');
    channel.bind('my-event', function(data) {
    //   alert(JSON.stringify(data.from));

    const time_now = new Date();
    const timenow = time_now.toLocaleTimeString('en-US', {hour: '2-digit',minute: '2-digit',});  
    if(data.message!=null){
        if($('#conversation_container').attr('chat_user_id')==JSON.stringify(data.from)){
            // refresh conversation 
            $('#conversation_container').prepend(
                '<div class="row w-100 d-flex justify-content-end">'+
                '<div class="w-auto p-3 rounded-4 bg-info">'+
                    '<b class="">'+data.message+'</b><br>'+
                    '<small>'+timenow+'</small>'+
                '</div>'+
                '</div>'+
                '<br>'
            )
            $(function(){
                jQuery.ajax({
                    url:'/chat/'+data.from,
                    method:'get',
                    data:{
                        id:data.from,
                    },
                    success:function(){
                        // now the message is marked that you as read message
                    }
                })
            })


        }
        else{
            // alert('here is message')
            // pending=parseInt($('#'+data.from).parent().find('b').text())
            // a=$('#'+data.from).parent().find($('b'))
            // if(isNaN(pending)){
            //     a.text('1')            
            // }else{
            //     pending=pending+1
            //     a.text(pending)
            // }         

            $('#pending-'+data.from).removeClass('d-none')
        }
    }  
    });


    
   
</script>
    

@endauth



</body>
</html>
