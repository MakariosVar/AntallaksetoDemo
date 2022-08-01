<template>
        <div id="Interface">
                <div v-if="demo == 0" id="DemoVersion" class="fixed-top">    
                        <div class="d-flex flex-column p-5 text-center align-items-center">   
                                
                                <h4 class="modalHeader text-white">Καλωσήρθατε στο ΑνταλλαξέΤο</h4>
                                
                                <p class="text-white responsive-font">Η παρών έκδοση είναι δοκιμαστική, πολύ πιθανών να υπάρχουν ψεύτικες αγγελίες.</p>  
                                <p class="text-white responsive-font">Παρακαλούμε πολύ να μην δώσετε ευαίσθητα πρωσοπικά δεδομένα.</p>           
                                <p class="text-white responsive-font">Είστε ελεύθεροι να χρησιμοποιήσετε την σελίδα όπως αγαπάτε.</p>  
                                <p class="text-white responsive-font"> Θα χαρούμε πολύ να δούμε τα μυνήματά σας απο την σελίδα επικοινωνίας.</p>  
                                <p class="text-white responsive-font"> Πείτε μας τι σας άρεσε και τι θα θέλατε να διαμορφώσουμε</p>            
                                <a class="u-border-2 u-border-white w-25 u-button-style u-hover-grey-25 u-none u-text-hover-white u-btn-1" @click="DemoCheck()">Κατανοώ</a> 

                        </div>
                </div> 
                <HeaderVue :loggedin="loggedin" :user="user"></HeaderVue> 
                        <router-view @userID="getUser($event)" :loggedin="loggedin" :user="user" :key="$route.params.id"></router-view>
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
                props: ['sessionloggedin', 'sessionuser'],  
                
                data() {
                        return {
                                loggedin: 0,
                                user:  null,
                                demo:0,
                        }
                },
                

                methods: {
                        getUser(User)
                        {
                                this.user = User
                                this.loggedin = 1  
                        },
                        DemoCheck()
                        {
                                localStorage.setItem('demo', 1); 
                                this.demo = 1  
                        }
                        
                },
                computed:{
                                                
                },
 
                mounted(){
                        
                        if(localStorage.getItem('demo') == 1){
                                this.demo = 1 
                        }
                        this.user = this.sessionuser;
                        this.loggedin = this.sessionloggedin;
                        window.scrollTo(0, 0);
                        }
        }
</script>