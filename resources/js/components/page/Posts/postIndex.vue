<template>
 <section class="u-clearfix u-gradient" id="sec-64c3" style="min-height:700px;">
      <div class="u-clearfix u-sheet u-sheet-1">
	      <div class="text-center">
		      <h1 class="u-align-center u-text u-text-1">Όλες οι αγγελίες</h1>
	      </div>
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="d-flex justify-content-center">
              <div>
                <div class="u-container-layout u-container-layout-1">
                  <div class="u-expanded-width u-form u-form-1">
                    
                    
                   <form id="SearchForm" class="row justify-content-center pb-5">
                      
                       
                      <div class="u-form-group u-form-name u-label-top">
                        <label for="title" class="u-label">Αναζήτηση</label>
                        <input v-model="searchTitle" id="title" type="text" class="u-border-1 u-border-grey-30  u-input-rectangle u-white form-control" placeholder="Ψάχνω για.." name="title">
                      </div>

   
                      <div class="u-form-group u-label-top">
                        <label for="category" class="u-label">Κατηγορία</label>
                        <select v-model="searchCategory" id="category" name="category"  class="form-select form-control form-control"  aria-label="category">
                            <option value="all" selected>Όλες οι Κατηγορίες</option>
                            <option v-for="category in categories" v-bind:key="category.id"  :value="category.title">{{ category.title+'('+category.count+')'}}</option>
                        </select>
                      </div>
                      
               
                   
                   </form>
                       
                  
                  </div>
                </div>
              </div>
              </div>
                <adsense></adsense>
              <div class="u-container-style u-layout-cell u-size-48 u-layout-cell-2">
                <div class="d-flex justify-content-center u-container-layout u-container-layout-2 p-1 u-border-1">
                  <div v-if="!(Loaded)">
                      <PreLoader></PreLoader>  
                  </div> 
                  <div v-else>
                    <div v-if="!(ListResult[0])" class="text-center">
                      <h2> Καμία Αγγελία</h2>
                      <h3>Δοκιμάστε άλλες λέξεις-κλειδία ή Κατηγορία</h3>
                    </div>
		              <section v-else class="post-list">
		                <router-link v-for="post in ListResult" :key="post.id" :to="'/p/'+post.id" class="post">
 			                  <figure class="post-image">
     			                  <img :src="`/storage/${post.image0}`">
   			                </figure>
    		                <span class="post-overlay ">
			                    <div class="d-inline-block">
		 	                      <h5>	
			                        <span style="color:white; ">{{ post.title}}</span>	
     			                  </h5>
			                      <p>
			    	                  <span style="color:white; ">Περιοχή : </span>
			 	                      <span style="color:white; font-size:13px;">{{ post.adlocation}}</span>
			                      </p>
			                    </div>
		                    </span>
 		                </router-link>
		
	
	                </section>
                  </div>
	
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 


       
</template>
<script>


     export default {
       
        data() {
            return {
              posts: {},
              categories: {},
              searchTitle: null,
              searchCategory: 'all',
              Loaded: false

            }
       },
       methods:{
                getPosts(){
                        axios.get('/api/vue/posts').then((response) => {
                                this.posts = response.data;
                                this.Loaded = true;
                        });
                },
                getCategories(){
                        axios.get('/api/vue/categories').then((response) => {
                                this.categories = response.data
                        });
                  },
                queryCaught(){
                
                  if(this.$route.query.category){
                    this.searchCategory = this.$route.query.category;
                  }
                  if(this.$route.query.search){
                    this.searchTitle = this.$route.query.search;
                  }
                }
       },
       computed:{
                ListResult(){ 
                     
                           
                         
                        
                    if (this.searchTitle) {
                      return this.posts.filter(item => {
                        return this.searchTitle.toLowerCase().split(" ").every(v => item.title.toLowerCase().includes(v));
                      });
                    }else if((this.searchCategory) != 'all'){return this.posts.filter(item => {
                        return this.searchCategory.toLowerCase().split(" ").every(v => item.category.toLowerCase().includes(v));
                      });
                      }else{
                      return this.posts;
                    }
                },
                
      },
      created(){
        this.getCategories();
        this.getPosts(); 
        this.queryCaught();
      }
    }

 

</script>
