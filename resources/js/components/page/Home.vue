<template>
<div id="homepage">
<section class="u-align-center u-clearfix u-image u-shading u-section-1" src="" id="sec-834e" data-image-width="2427" data-image-height="2243">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-align-center u-custom-font u-font-lobster u-text u-text-default u-text-1 home-text">Ανταλλαξέ το</h1>
        <h2 class="u-align-center u-subtitle u-text u-text-default u-text-1 home-text">Δώσε ο,τι δεν χρειαζεσαι</h2>
   
        <h2 class="u-subtitle u-text u-text-default u-text-2 home-text">Βρες ο,τι χρειαζεσαι</h2>
        <router-link v-if="loggedin" to="/p/create" class="u-border-2 u-border-white u-btn u-button-style u-hover-grey-25 u-none u-text-hover-white u-btn-1">ΠΡΟΣΘΗΚΗ ΑΓΓΕΛΙΑς</router-link>
        <router-link v-else to="/login" class="u-border-2 u-border-white u-btn u-button-style u-hover-grey-25 u-none u-text-hover-white u-btn-1">ΠΡΟΣΘΗΚΗ ΑΓΓΕΛΙΑς</router-link>
      </div>
</section>

<section  class="u-align-center u-clearfix u-section-2" id="sec-ac43"> 
      <div  class="u-align-left u-clearfix u-sheet u-sheet-1">
        <p class="u-text u-text-default u-text-1">
          <span style="font-size: 2.25rem;">Κορυφαίες Κατηγορίες</span> 
        </p>
        <PreLoader v-if="(categories == {})"></PreLoader>
        <div v-else class="u-expanded-width u-layout-horizontal u-list u-list-1"> 
          <div class="u-repeater u-repeater-1">
                
                
                <router-link v-for="category in categories" :key="category.id" :to="{ path: '/p', query: { category: category.title }}"  class="u-container-style u-list-item u-repeater-item">
                    <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                        <span class="u-icon u-icon-circle u-text-palette-2-base u-icon-1">
                          <div v-html="category.svg"></div> 
                             
                        </span>
                        <p class="u-align-center u-text u-text-default u-text-1">{{ category.title }}</p> 
                        <p class="u-align-center u-text u-text-default u-text-3 pb-5">{{ category.count }} Αγγελίες</p>
                    </div>
                </router-link> 
                  
               
          </div>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-1"  role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
          </a>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-2"  role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
          </a>
        </div>
        <router-link to="/p" class="u-align-center u-border-2 u-border-black u-btn u-button-style u-hover-black u-none u-text-hover-white u-btn-1">ΔΕΙΤΕ ΟΛΕΣ ΤΙΣ ΑΓΓΕΛΙΕΣ</router-link>
      </div>
    </section>
    <ads></ads> 
    <section class="u-clearfix u-section-3" id="sec-afdd">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-1">Προωθημένες Αγγελίες</h2>
        <div class="u-expanded-width u-layout-grid u-list u-list-1">
        <div class="u-repeater u-repeater-1">

   
            <div v-for="post in premiumPosts" :key="post.id" class="u-border-2 u-border-grey-75 u-container-style u-list-item u-repeater-item u-shape-rectangle u-list-item-1 premiumhomefix">
                <div class="u-container-layout mt-3 mb-3  u-similar-container u-valign-middle u-container-layout-1">
                    <router-link :to="'/p/'+post.id">
                        <h3 class="u-align-center u-text u-text-2">{{ post.title }}</h3>
                   
                            <img class="u-image u-image-default u-preserve-proportions u-image-1" :src="`/storage/${post.image0}`" alt="" data-image-width="1080" data-image-height="1080">
                    </router-link> 

                    <router-link :to="'/p/'+post.id">
                            <p class="u-align-center u-text u-text-3">
                                {{ post.description.substr(0, 150) }} 
                            </p>        
                    </router-link> 
                </div>
            </div>
         
     <div class="u-border-2 u-border-grey-75 u-container-style u-list-item u-repeater-item u-shape-rectangle u-list-item-1 premiumhomefix">
            <div class="u-container-layout u-similar-container u-valign-middle u-container-layout-1">
              
                    <router-link to="#">
                        <h3 class="u-align-center u-text u-text-2">ΠΡΟΩΘΗΣΕ ΤΗΝ ΑΓΓΕΛΙΑ ΣΟΥ</h3>
                    </router-link>
                   
                    <router-link to="#">
                 
                        <img class="u-image u-image-default u-preserve-proportions u-image-1" src="/images/premium.png" alt="" data-image-width="1080" data-image-height="1080">
                    </router-link>
                    
                    <router-link to="#">
                  
                        <p class="u-align-center u-text u-text-3">Πατήστε εδώ για να επιλέξετε ή να προσθεσετε μια νέα</p>
                    </router-link>
                </div>
            </div>
       
            
          </div>
        </div>
      </div>
    </section>


        
</div>

</template>

<script>
       export default {
        
        props:['loggedin'],

        data() {
            return {
                premiumPosts: {},
                categories: {},
            }
        },
        methods:{
              getPremiumPosts(){
                     axios.get('/api/vue/premiumPosts').then((response) => {
                     this.premiumPosts = response.data
                     })
              },
              getCategories(){
                     axios.get('/api/vue/categories').then((response) => {
                     this.categories = response.data
                     })
              }
              },
              created(){
                    this.getPremiumPosts()
                    this.getCategories()
              }
        }
</script>