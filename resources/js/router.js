import Router from 'vue-router'

export default new Router({
    mode: 'history',
    routes: [
        // home
        { name: 'home', path: '/', component: require('./components/HomeComponent.vue').default },

        // user
        { name: 'user', path: '/user', component: require('./components/user/Index.vue').default },

        // group
        { name: 'group', path: '/group', component: require('./components/group/Index.vue').default },

        // chat
        { name: 'chat', path: '/group/chat/:group_id', component: require('./components/chat/Index.vue').default, props: true },

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