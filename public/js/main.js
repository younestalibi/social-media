$(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
// button follow in profile
$("#btn_follow_in_profile").click(
  
    function(){ 
        profile_id=$('#btn_follow_in_profile').attr('user')
        
        jQuery.ajax({
            url:'/follow/'+profile_id,
            method: 'get',
            success: function(result){
                $('#followers').load(" #followers")
                // $('#btn_follow_in_profile').load(" #btn_follow_in_profile")
                // $('#followers_refresh').load(" #followers_refresh")
                // alert('hello')
                if(result=="Unfollw"){
                    $('#btn_follow_in_profile').removeClass('btn-primary')
                    $('#btn_follow_in_profile').text(result)
                }else if(result=='Follow'){
                    $('#btn_follow_in_profile').addClass(' btn-primary')
                    $('#btn_follow_in_profile').text(result)
                }
                
            },
        });
    }

)
// button follow in page home
$(".btn_follow_in_home").click(
    function(){
        btn=$(this)
        profile=btn.parent().parent().parent()

        jQuery.ajax({
            url:'/follow/'+btn.attr('user'),
            method: 'get',
            success: function(result){
                profile.hide()
                $('#posts').load(" #posts")
            },
        });
    }

)
// comment btn
$(".posting").click(
    function(){
        post_id=$(this).attr('post_id')
       VeiwAll= $(this).parent().parent().parent().find('.show_comments')
        body=$(this).prev().val()
        jQuery.ajax({
            url:'/home/create/comment/'+post_id,
            data:{
                target:body,
            },
            method: 'get',
            success: function(data){
                $('.comment').val('')
                // hi.css('display','none')
                VeiwAll.text('view all '+data+' comments')
            },
        });
    }
)



// like button
$(".click_like").click(
    function(){
        btn=$(this)
        post_id=$(this).attr('post_id')
        jQuery.ajax({
            url:'/home/create/like/'+post_id,
            method: 'get',
            success: function(data){   
                // location.reload(true)
                
                // btn.parent().find('.likes_count').attr('post_id',post_id).text(data[1]+'Likes')
                btn.parent().parent().parent().find('.likes_count').attr('post_id',post_id).text(data[1]+'Likes')
                console.log(post_id)
                if(data[0]=='Dislike'){
                    btn.find('i').removeClass('bi-heart')
                    btn.find('i').addClass('bi-heart-fill')
                    btn.addClass('text-danger')
                }
                else if(data[0]=='Like'){
                    btn.find('i').removeClass('bi-heart-fill')
                    btn.find('i').addClass('bi-heart')
                    btn.removeClass('text-danger')


                }
            },
        });
    }
)
// click on post
$(".click_post").click(
    function(e){
        post_id=$(this).attr('post_id')
        post=$(this)
        comment=post.parent().parent().parent().find('.modal').find('.comments')
        likes_count=post.parent().parent().parent().find('.modal').find('.likes_count')
        jQuery.ajax({
            url:'/home/show_post/'+post_id,
            method: 'get',
            beforeSend: function() {
                comment.text('wait a minute')
            },
            success: function(result){
                comment.html('')
                likes_count.text(result[1]+" Likes")
                result[0].forEach(ele => {
                    comment.append(
                        "<img style='object-fit: cover;' src='/storage/"+ele['image']+"' class='mt-2' alt='hi' id='img_post'>",
                        "<a href='profile/"+ele['user_id']+"'><b>"+ele['name']+"</b></a>",
                        "<div class='mx-2 d-inline' class=comments>"+ele['comment']+"</div><br>"
                    )  
                });
                post.parent().parent().parent().find('.modal').css('display','block')
                $(".image").css("background-image", "url("+post.attr('src')+")");
                $("#description").text(post.attr('description'))
            },
        });
    }
)
// search in the nav bar 
$('#search').on('keyup', function(){
    search=$(this).val(),
    jQuery.ajax({
        url:'/home/search/'+search,
        method: 'get',
        data:{
            target:search,
        },
        success: function(result_search){   
            $('#search_resault').html('')
            if(result_search.length>0){
                result_search.forEach(ele => {
                    console.log(ele['id'])
                    $('#search_resault').append('<li class="list-group-item ">'+
                    // '<img src="'+ele['user_name']+'" alt="pic">'+
                    '<a href="/profile/'+ele['id']+'">'+ele['user_name']+'</a>'+
                    '</li>')
                    $('#search_resault').slideDown()
                });
            }
            else{
                $('#search_resault').append('<li class="list-group-item">there is no results</li>')
            }
            $( "#search" ).focusout(function() {
                $('#search_resault').slideUp()
            });
        },
    });
})
// send message button
$("#send_message").click(
    function(){
        btn=$(this)
        sent_message=$('input[id="message"]').val()
        if(sent_message.length>0){
            const time_now = new Date();
            const timenow = time_now.toLocaleTimeString('en-US', {hour: '2-digit',minute: '2-digit',}); 
            $('#conversation_container').prepend(
                '<div class="row w-100 d-flex">'+
                    '<div class="w-auto p-3 rounded-4 bg-success">'+
                        '<b class="">'+sent_message+'</b><br>'+
                        '<div class="d-flex justify-content-start align-items-center">'+
                            '<span><i class="bi bi-check2"></i></span>'+
                            '<small style="font-size:11px;">'+timenow+'</small>'+  
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<br></br>'
            )
            $('input[id="message"]').val('')
            jQuery.ajax({
                url:'/sendmessage',
                method: 'post',
                data:{
                    to:reciver_id,
                    message:sent_message
                },
                success: function(data){    
                    console.log('message sent')
                },
            });
        }
        
    }
)
// click on user to get messages of conversation
$(".users").click(
    function(){
        btn_user=$(this)
        // btn_user.parent().find('.pending').text('') 
        reciver_id=btn_user.attr('id')
        sender=btn_user.attr('user')
        $('#conversation_container').html("")
        $('#conversation_container').attr("chat_user_id",reciver_id)
        $('.friends').css('background-color','')
        btn_user.css('background-color','#93addf99')
        $('#profile_user_chat').removeClass('d-none')
        $('#chat_window_message').addClass('d-none')
        $('#chat_section').removeClass('d-none')
        $('#profile_user_chat').find('#username_profile').text(btn_user.attr('name'))
        $('#profile_user_chat').find('#status_profile').text(btn_user.attr('status'))
        $('#profile_user_chat').find('img').attr('src',(btn_user.attr('image')))
        $('#back').addClass('d-none')
        $('#pending-'+reciver_id).addClass('d-none')


        if($(window).width() < '576'){
            $('#window_chat').removeClass('d-none')
            $('#list_friends').addClass('d-none')
            $('#back').removeClass('d-none')
            $('#profile_user_chat').removeClass('justify-content-end')
            $('#profile_user_chat').addClass('justify-content-between')

        }
        jQuery.ajax({
        url:'/chat/'+reciver_id,
        method:'get',
        data:{
            id:reciver_id,
        },
        beforeSend: function() {
            $('#conversation_container').html(
                "<div class='h-100 text-center justify-content-center flex-column d-flex w-50 m-auto text-muted'>"+
                    "<h1>Wait a moment...</h1>"+
                "</div>"
            )
        },
        success: function(data){
            $('#conversation_container').html('')
            data.forEach(message => {
                const time_now = new Date(message.created_at);
                const timenow = time_now.toLocaleTimeString('en-US', {hour: '2-digit',minute: '2-digit',});  
                if(message.from==sender && message.to==reciver_id){
                    $('#conversation_container').prepend(
                        '<div class="row w-100 d-flex">'+
                            '<div class="w-auto p-3 rounded-4 bg-success">'+
                                '<b class="">'+message.message+'</b><br>'+
                                '<div class="d-flex justify-content-start align-items-center">'+
                                    '<span><i class="bi '+(message.is_read==1?"bi-check2-all":"bi-check2")+'"></i></span>'+
                                    '<small style="font-size:11px;">'+timenow+'</small>'+  
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<br></br>'
                    )
                }

                else if(message.from==reciver_id && message.to==sender){
                    $('#conversation_container').prepend(
                        '<div class="row w-100 d-flex justify-content-end">'+
                        '<div class="w-auto p-3 rounded-4 bg-info">'+
                            '<b class="">'+message.message+'</b><br>'+
                            '<small>'+timenow+'</small>'+

                        '</div>'+
                        '</div>'+
                        '<br>'
                    )
                }
                
                
            });


            
        },
        });
    }
)

// for set the width and height of posts in profile 
// setInterval(()=>{
//     $('.bob').css('height',$('.bob').css('width'))
// },1000)

$('#back').click(
    function(){
        $('#window_chat').addClass('d-none')
        $('#list_friends').removeClass('d-none')
        $('.users').css('background-color','')
    })



})
function closing(){
    post.parent().parent().parent().find('.modal').css('display','none')
}

// popup
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');
window.addEventListener('click', function(e) {
    if(e.target.id == modal.id || e.target.id ==modal2.id || e.target.id ==modal3.id) {
        console.log('hi')
        e.target.style.display="none";
        console.log(e.target.style.width)

    }
})
function showImg(e){
    $(function(){
        console.log($(e).attr('id'))
        $(".image").css("background-image", "url(/storage/"+$(e).attr('id')+")");
        $('#id03').css('display','block')
        $("#description").text($(e).attr('description'))
        comments=$(e).attr('com')
        ne=comments.split(',')
        da=JSON.parse(comments)
        $('#comm').html('')
        da[0].forEach(ele => {
            $('#comm').append(
                "<img src='/storage/"+ele['image']+"' class='mt-2' alt='hi' id='img_post'>",
                "<b>"+ele['name']+"</b>",
                "<div class='mx-2 d-inline' class=comments>"+ele['comment']+"</div><br>"
            )

        });

    })
}



