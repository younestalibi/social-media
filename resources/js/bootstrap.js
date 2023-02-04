import _ from 'lodash';
window._ = _;

import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';
import { useSSRContext } from 'vue';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// }); 
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0fc33308824f759cdafe',
    cluster: 'eu',
    encrypted: true
});
var StatusUser;
window.Echo.join('chat')

.joining((user) => {
    StatusUser='Online'
    jQuery.ajax({
        url:'/Online/'+user.id,
        method: 'get',
    });
})
.listen('UserOnline', (e) => {
    if(StatusUser=='Online'){
        $('.user-'+e.user.id).text('Is Online')
        $('.status-'+e.user.id).removeClass('bg-danger')
        $('.status-'+e.user.id).addClass('bg-success')
        $('#profile_user_chat').find('#status_profile').text('Online')
    }
    else if(StatusUser=='Offline'){
        $('.user-'+e.user.id).text('Is Offline')
        $('.status-'+e.user.id).removeClass('bg-success')
        $('.status-'+e.user.id).addClass('bg-danger')
        $('#profile_user_chat').find('#status_profile').text('Offline')
    }
})
.leaving((user) => {
    StatusUser='Offline'
    jQuery.ajax({
        url:'/Offline/'+user.id,
        method: 'get',
    });
    
})


