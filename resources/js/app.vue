<template>
        <div id="Interface">
                <HeaderVue :loggedin="loggedin" :user="user"></HeaderVue> 
                        <router-view @userLogged="getUser($event)" :loggedin="loggedin" :user="user" :key="$route.params.id"></router-view>
                <FooterVue></FooterVue>       
        </div>
</template>


<style>
        #DemoVersion 
        { 
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.95);
        }

/* If the screen size is 1200px wide or more, set the font-size to 80px */
        @media (min-width: 1200px) {
        .responsive-font {
                font-size: 30x;
                }
        }
/* If the screen size is smaller than 1200px, set the font-size to 80px */
        @media (max-width: 1199.98px) {
        .responsive-font {
                font-size: 13px;
                }
        }
</style>
<script>
        export default {
                data() {
                        return {
                                loggedin: 0,
                                user:  null,
                        }
                },
                methods: {
                        getUser(User)
                        {
                                this.user = User
                                this.loggedin = 1

                                localStorage.setItem('user', JSON.stringify(User))
                        },
                        
                },
                created(){
                        this.loggedin =  0;
                        var storageUser = localStorage.getItem('user');
                        if (storageUser && storageUser != 'null') {
                                this.user = JSON.parse(storageUser)
                                this.loggedin =  1;
                        }
                        window.scrollTo(0, 0);
                }
        }
</script>