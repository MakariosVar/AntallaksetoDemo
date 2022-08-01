<template>
      <header class="u-clearfix u-header u-header">
      
               
        <div class="u-clearfix u-sheet u-valign-top u-sheet-1">
          <router-link to="/home" class="u-image u-logo u-image-1" data-image-width="1080" data-image-height="1080" title="Αρχική">
            <img src="/images/NewLogoPNG.svg" class="u-logo-image u-logo-image-1">
          </router-link>
          <nav class="u-align-center u-menu u-menu-dropdown u-offcanvas u-menu-1">
            <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
              <a class="u-button-style u-custom-active-border-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                <svg class="u-svg-link" viewBox="0 0 24 24"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
                <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect></g></svg>
              </a>
            </div>
            <div class="u-custom-menu u-nav-container">
              <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
               
                <li class="u-nav-item">
                  <router-link class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" to="/home" style="padding: 10px 0px;">Αρχική</router-link>
                </li>
                <li class="u-nav-item">
                  <router-link class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" to="/p" style="padding: 10px 0px;">Αγγελίες</router-link>
                </li>

                <li class="u-nav-item">
                  <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;">
                    Σχετικα με εμας
                  </a>
                  <div class="u-nav-popup">
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">
                      <li class="u-nav-item">
                        <router-link class="u-button-style u-nav-link u-white" to="/info">Πληροφορίες</router-link>
                      </li>
                      <li class="u-nav-item">
                        <router-link class="u-button-style u-nav-link u-white" to="/contact">Επικοινωνία</router-link>
                      </li>
                    </ul>
                  </div> 
                </li>
                <li class="u-nav-item">
                 
                  
                  <a v-if="loggedin"  class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;">{{ user.name }}</a>
                  <a v-else class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;">Λογαριασμός</a>
                
                  <div class="u-nav-popup">
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">


                
                  
                      <li v-if="!loggedin" class="u-nav-item">
                          <router-link class="u-button-style u-nav-link u-white" to="/login">Σύνδεση</router-link>
                      </li>
              
    
                 
                      <li v-if="!loggedin" class="u-nav-item">
                        <router-link class="u-button-style u-nav-link u-white" to="/register">Εγγραφή</router-link>
                      </li>
    
                     

             
              
                    <li v-if="loggedin" class="u-nav-item"> 
                       <router-link class="u-button-style u-nav-link u-white" :to="'/myposts/'+this.user.id">Οι Αγγελίες μου</router-link>
                    </li> 
                    <li v-if="loggedin" class="u-nav-item"> 
                       <router-link class="u-button-style u-nav-link u-white" to="/p/create">Nεα αγγελια</router-link>
                    </li> 

                    <li v-if="loggedin" class="u-nav-item"> 
                      <router-link class="u-button-style u-nav-link u-white" :to="'/profile/'+this.user.id">Προφίλ </router-link>
                    </li> 

                    <li v-if="loggedin" class="u-nav-item"> 
                      <a class="u-button-style u-nav-link u-white" href="#" @click.prevent="logout()">Αποσύνδεση</a>  
                    </li>
                  </ul>
                </div>
              </li> 
              
              
              
              <li v-if="loggedin && user.role_id == 1" class="u-nav-item">
               <a class="u-button-style u-nav-link">ADMIN</a>
                  <div class="u-nav-popup">
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">


                
                  
                      <li  class="u-nav-item">
                          <a class="u-button-style u-nav-link u-white" href="/admin">PANEL Voyager</a>
                      </li>
              
    
                 
                      <li  class="u-nav-item">
                        <router-link :user="user" class="u-button-style u-nav-link u-white" to="/verificateposts">Εξέταση Αγγελιών--[{{this.pending}}]--</router-link>
                      </li>

                      <li  class="u-nav-item">
                        <router-link class="u-button-style u-nav-link u-white" to="/messages">Μηνύματα</router-link>
                      </li>
                       
                    </ul>
                  </div>
              </li>
              <li v-if="loggedin && user.role_id == 3" class="u-nav-item">
               <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;">Moderator</a>
                  <div class="u-nav-popup">
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">


                
                  
                       <li  class="u-nav-item">
                        <router-link class="u-button-style u-nav-link u-white" to="/messages">Μηνύματα</router-link>
                      </li>
              
    
                 
                      <li  class="u-nav-item">
                        <router-link :user="user" class="u-button-style u-nav-link u-white" to="/verificateposts">Εξέταση Αγγελιών--[{{this.pending}}]--</router-link>
                      </li>

                      
                        
                    </ul>
                  </div>
              </li>





              </ul>
          </div>


<!--                         *************** RESPONSIVE MENU **********************-->

          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close">
                </div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-4">
                  <li class="u-nav-item" @click="closeResponsiveMenu"> 
                    <router-link class="u-button-style u-nav-link"  to="/home">Αρχική</router-link>
                    <hr class="u-white"> 
                  </li>
                  <li class="u-nav-item" @click="closeResponsiveMenu">
                    <router-link class="u-button-style u-nav-link"  to="/p">Αγγελίες</router-link>
                    <hr class="u-white"> 
                  </li>
                  <li class="u-nav-item">
                  
                     
                      <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">
                        <li class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link class="u-button-style u-nav-link" to="/info">Πληροφορίες</router-link>
                        </li>
                        <li class="u-nav-item" @click="closeResponsiveMenu">
                          <router-link class="u-button-style u-nav-link" to="/contact">Επικοινωνία</router-link>
                        </li>
                      </ul>
                    <hr class="u-white">  
                  </li>
                  
                   <li class="u-nav-item">
                 
                  
                  
                
                 
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">


                
                  
                      <li v-if="!loggedin" class="u-nav-item" @click="closeResponsiveMenu">
                          <router-link class="u-button-style u-nav-link" to="/login">Σύνδεση</router-link>
                      </li>
              
    
                 
                      <li v-if="!loggedin" class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link class="u-button-style u-nav-link" to="/register">Εγγραφή</router-link>
                      </li>
    
                     

             
              
                    <li v-if="loggedin" class="u-nav-item" @click="closeResponsiveMenu"> 
                       <router-link class="u-button-style u-nav-link" :to="'/myposts/'+this.user.id">Οι Αγγελίες μου</router-link>
                    </li> 
                    <li v-if="loggedin" class="u-nav-item"> 
                       <router-link class="u-button-style u-nav-link" to="/p/create">Nεα αγγελια</router-link>
                    </li> 

                    <li v-if="loggedin" class="u-nav-item" @click="closeResponsiveMenu"> 
                      <router-link class="u-button-style u-nav-link" :to="'/profile/'+this.user.id">Προφίλ </router-link>
                    </li> 

                    <li v-if="loggedin" class="u-nav-item"> 
                      <a class="u-button-style u-nav-link" href="#" @click.prevent="logout()">Αποσύνδεση</a>  
                    </li>
                  </ul>
                
              </li> 
              <hr class="u-white">
              
              
              <li v-if="loggedin && user.role_id == 1" class="u-nav-item">
               
                  
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">
 

                
                  
                      <li  class="u-nav-item" @click="closeResponsiveMenu">
                          <a class="u-button-style u-nav-link" href="/admin">PANEL Voyager</a>
                      </li>
              
    
                 
                      <li  class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link :user="user" class="u-button-style u-nav-link" to="/verificateposts">Εξέταση Αγγελιών--[{{this.pending}}]--</router-link>
                      </li>

                      <li  class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link class="u-button-style u-nav-link" to="/messages">Μηνύματα</router-link>
                      </li>
                       
                    </ul>
                  
              </li>
              <li v-if="loggedin && user.role_id == 3" class="u-nav-item">
             
                  <div class="u-nav-popup">
                    <ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">


                
                  
                       <li  class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link class="u-button-style u-nav-link" to="/messages">Μηνύματα</router-link>
                      </li>
              
    
                 
                      <li  class="u-nav-item" @click="closeResponsiveMenu">
                        <router-link :user="user" class="u-button-style u-nav-link" to="/verificateposts">Εξέταση Αγγελιών--[{{this.pending}}]--</router-link>
                      </li>

                      
                        
                    </ul>
                  </div>
              </li>





              </ul>
          </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70">
            </div>
          </div>
          </nav>
      </div>
      <div class="text-center bg-warning"> 
        <h5>Δοκιμαστική έκδοση // DEMO</h5> 
      </div>
    </header> 
</template>

<script>
        export default {
                props: ['loggedin', 'user'],

                data(){
                  return{
                      pending:0
                  }
                },

                methods: {
                        logout() {
                          
                            axios.post('/api/vuelogout').then((response) => {
                                localStorage.setItem('loggedin', 0)
                                localStorage.setItem('user', null)
                                location.replace('/home');
                            });
                         },
                        getPendingPosts(){ 
                           axios.get('/api/vue/toverificate').then((response) => {
                                        
                                      this.pending = Object.keys(response.data).length;
                                })
                        },
                        closeResponsiveMenu(){ 
                          document.querySelector('.u-menu-close').click();
                        }
                        
                },
                created(){ 
                    this.getPendingPosts();
                },
                computed:{
                      checkPost(){
                        this.getPendingPosts();
                        return 'updated';
                      } 
                  }
                
        }  
</script>