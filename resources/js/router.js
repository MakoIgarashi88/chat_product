import Router from 'vue-router'

export default new Router({
    mode: 'history',
    routes: [
        // home
        { name: 'home', path: '/', component: require('./components/HomeComponent.vue').default },

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