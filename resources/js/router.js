import Router from 'vue-router'

export default new Router({
    mode: 'history',
    routes: [
        // home
        { name: 'home', path: '/', component: require('./components/HomeComponent.vue').default },

        //topic
        { name: 'topic', path: '/topic', component: require('./components/topic/Index.vue').default },
        { name: 'topic.show', path: '/topic/:topic_id', component: require('./components/topic/Show.vue').default, props: true },

        // user
        { name: 'user', path: '/mypage', component: require('./components/user/Mypage.vue').default },
        { name: 'user.show', path: '/user', component: require('./components/user/Show.vue').default },
        { name: 'friend.show', path: '/user/:user_id', component: require('./components/user/Friend.vue').default, props: true },

        // group
        { name: 'group', path: '/group', component: require('./components/group/Index.vue').default },

        // chat
        { name: 'chat.private', path: '/private/chat/:friend_id', component: require('./components/chat/private/Private.vue').default, props: true },
        { name: 'chat.group', path: '/group/chat/:group_id', component: require('./components/chat/group/Group.vue').default, props: true },

        // not found
        { name: 'not.fount', path: '*', component: require('./components/commons/NotFoundComponent.vue').default },
        // unauthorized
        { name: 'unauthorized', path: '/unauthorized', component: require('./components/commons/UnauthorizedComponent.vue').default },
]
});

/**
 * Navigation guard
 * 
 * If the user is a viewer, redirect to the unauthorized screen
 */
// router.beforeResolve((to, from, next) => {
//     var id = setInterval(function(){
//         // wait until is_viewer is defined
//         if(store.state.user.is_viewer !== undefined){
//             // If the user is a viewer, redirect to the unauthorized screen
//             if (!store.state.user.is_admin) {
//                 if (to.name === 'setting' || to.name.match(/employee*/)) {
//                     // Avoid infinite loop
//                     if (to.name !== 'unauthorized') next('/unauthorized')
//                     else next()
//                 } else {
//                     next()
//                 }
//             } else {
//                 next()
//             }
//             clearInterval(id)
//         }
//     }, 100)     // 0.1 second interval
// })