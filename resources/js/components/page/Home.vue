<template>
<div id="homepage">
<section class="u-align-center u-clearfix u-image u-shading u-section-1 text-center" src="" id="sec-834e" data-image-width="2427" data-image-height="2243">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-align-center u-custom-font u-font-lobster u-text u-text-default u-text-1 home-text">Ανταλλαξέ το</h1>
        <h2 class="u-align-center u-subtitle u-text u-text-default u-text-1 home-text">Δώσε ο,τι δεν χρειάζεσαι</h2>
        <div class="d-flex justify-content-center">
          <router-link v-if="loggedin" to="/p/create" class="u-border-2 u-border-white u-btn u-button-style u-hover-grey-25 u-text-hover-white text-center">ΠΡΟΣΘΗΚΗ ΑΓΓΕΛΙΑΣ</router-link>
          <router-link v-else to="/login" class="u-border-2 u-border-white u-btn u-button-style u-hover-grey-25 u-text-hover-white text-center">ΠΡΟΣΘΗΚΗ ΑΓΓΕΛΙΑΣ</router-link>
        </div>
        <div class="text-center">
          <h2 class=" text-white">Βρες ο,τι χρειαζεσαι</h2>
        </div>
        <div class="d-flex justify-content-center mb-5">
          <b-form @submit.prevent="handleSearchSubmit" class="w-50">
            <b-form-input v-model="searchInputValue" size="lg" class="mr-sm-2" placeholder="Αναζήτηση..."></b-form-input>
          </b-form>
        </div>

      </div>
</section>

<section  class="u-align-center u-clearfix u-section-2" id="sec-ac43"> 
      <div  class="u-align-left u-clearfix u-sheet u-sheet-1">
        <p class="h2 text-center">
          <span style="font-size: 2.25rem;">Κορυφαίες Κατηγορίες</span> 
        </p>
        <PreLoader v-if="(categories == {})"></PreLoader>
        <div v-else class="u-expanded-width u-layout-horizontal u-list u-list-1"> 
          <div class="u-repeater u-repeater-1">
            <router-link v-for="category in categories" :key="category.id" @click="onClickCategory" :to="{ path: '/p', query: { category: category.title }}"  class="u-container-style u-list-item u-repeater-item">
                <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                    <span class="u-icon u-icon-circle u-text-palette-2-base u-icon-1">
                      <div v-html="category.svg"></div> 
                        
                    </span>
                    <p class="u-align-center u-text u-text-default u-text-1">{{ category.title }}</p> 
                    <p class="u-align-center u-text u-text-default u-text-3 pb-5">{{ category.count }} Αγγελίες</p>
                </div>
            </router-link>
          </div>
        </div>
        <div class="text-center">
          <router-link to="/p" class="btn btn-outline-secondary">ΔΕΙΤΕ ΟΛΕΣ ΤΙΣ ΑΓΓΕΛΙΕΣ</router-link>
        </div>
      </div>
    </section>
    <ads></ads> 
    <section>
      <div class="container">
        <h2 class="u-align-center u-text u-text-1">Προωθημένες Αγγελίες</h2>
        <div class="row">

          <div v-for="post in premiumPosts" :key="post.id" class="col-md-3 mb-4">
              <div>
                <router-link :to="'/p/' + post.id" class="text-decoration-none">
                  <div class="card h-100">
                    <img
                      :src="`/storage/${post.image0}`"
                      class="card-img-top"
                      alt="Post Image"
                    >
                    <div class="card-body">
                      <h5 v-b-tooltip.hover :title="post.title" class="card-title text-truncate mx-0 mb-1">{{ post.title }}</h5>
                      <p v-b-tooltip.hover :title="post.description" class="card-text text-truncate m-0">{{ post.description }}</p>
                    </div>
                  </div>
                </router-link>
              </div>
          </div>
        
          <div class="col-md-3 mb-4">
              <div>
                <router-link to="#" class="text-decoration-none">
                  <div class="card h-100">
                    <img
                      src="/images/premium.png"
                      class="card-img-top"
                      alt="Post Image"
                    >
                    <div class="card-body">
                      <h5 v-b-tooltip.hover title="ΠΡΟΩΘΗΣΕ ΤΗΝ ΑΓΓΕΛΙΑ ΣΟΥ" class="card-title text-truncate mx-0 mb-1">ΠΡΟΩΘΗΣΕ ΤΗΝ ΑΓΓΕΛΙΑ ΣΟΥ</h5>
                      <p v-b-tooltip.hover title="Πατήστε εδώ για να επιλέξετε ή να προσθεσετε μια νέα" class="card-text text-truncate m-0">Πατήστε εδώ για να επιλέξετε ή να προσθεσετε μια νέα</p>
                    </div>
                  </div>
                </router-link>
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
                searchInputValue: '',
            }
        },
        methods:{
          handleSearchSubmit (e) {
            e.preventDefault();
            this.$router.push({ path: '/p' , query: { search: this.searchInputValue } });
          },
          onClickCategory() {
            window.scrollTo(0, 0);
          },
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