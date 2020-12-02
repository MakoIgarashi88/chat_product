import Router from 'vue-router'

export default new Router({
    mode: 'history',
    routes: [
        // home
        { name: 'home', path: '/', component: require('./components/HomeComponent.vue').default },

        //topic
        { name: 'topic', path: '/topic', component: require('./components/topic/Index.vue').default },
        { name: 'topic.show', path: '/topic/first', component: require('./components/topic/Show.vue').default },

        // user
        { name: 'user', path: '/mypage', component: require('./components/user/Mypage.vue').default },
        { name: 'user.show', path: '/user', component: require('./components/user/Show.vue').default },

        // group
        { name: 'group', path: '/group', component: require('./components/group/Index.vue').default },

        // chat
        { name: 'chat.private', path: '/chat/private/', component: require('./components/chat/private/Private.vue').default, },
        { name: 'chat.group', path: '/chat/group', component: require('./components/chat/group/Group.vue').default },

        // sample
        { name: 'sample', path: '/sample', component: require('./components/Sample.vue').default },


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