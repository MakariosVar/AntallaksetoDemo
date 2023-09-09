<template>
  <b-navbar toggleable="md" type="light" class="px-5">
    <b-navbar-brand>
      <router-link to="/home" title="Αρχική">
        <img style="max-height: 70px;" src="/images/NewLogoPNG.png" alt="Logo">
    </router-link>
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item :to="{ path: `/p` }">
            <span class="text-dark">
              Αγγελίες
            </span>
        </b-nav-item>
        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <router-link to="#" class="text-dark">
              <em>
                Σχετικά με εμάς
              </em>
            </router-link>
          </template>
          <b-dropdown-item :to="{ path: `/info` }">
            <span class="text-dark">Πληροφορίες</span>
          </b-dropdown-item>
          <b-dropdown-item  :to="{ path: `/contact` }">
            <span class="text-dark">Επικοινωνία</span>
          </b-dropdown-item>
        </b-nav-item-dropdown>

      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-form @submit.prevent="handleSubmit" v-if="!isPostPage">
          <b-form-input v-model="searchInputValue" size="sm" class="mr-sm-2" placeholder="Search..."></b-form-input>
        </b-nav-form>
        
          <b-nav-item-dropdown right v-if="user && (user.role_id == 1 || user.role_id == 3)">
            <!-- Using 'button-content' slot -->
            <template #button-content>
              <b-icon icon="gear"></b-icon>
            </template>

            <b-dropdown-item v-if="user.role_id == 1">
              <a @click="toAdminPanel()" class="text-dark">Admin panel</a>
            </b-dropdown-item>
            <b-dropdown-item to="/verificateposts">
              <span class="text-dark">Εξέταση Αγγελιών ({{this.pending}})</span>
            </b-dropdown-item>
            <b-dropdown-item to="/messages">
              <span class="text-dark">Μηνύματα</span>
            </b-dropdown-item>
          </b-nav-item-dropdown>
          <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <span v-if="profileImage">
              <b-img style="max-width: 35px;" fluid :src="'/storage/'+profileImage" rounded="circle" alt="User"></b-img>
            </span>
            <b-icon v-else icon="person-circle"></b-icon>
          </template>
          <span v-if="loggedin">
            <b-dropdown-item :to="`/profile/${this.user.id}`">
              <span class="text-dark">Προφίλ / {{ user.name }}</span>
            </b-dropdown-item>
            <b-dropdown-item :to="`/p/create`">
              <span class="text-dark">Προσθήκη Αγγελίας</span>
            </b-dropdown-item>
            <b-dropdown-item :to="`/myposts/${this.user.id}`">
              <span class="text-dark">Οι Αγγελίες μου</span>
            </b-dropdown-item>
            <b-dropdown-item @click="logout">Αποσύνδεση</b-dropdown-item>
          </span>
          <span v-else>
            <b-dropdown-item to="/login">
              <span class="text-dark">Σύνδεση</span>
            </b-dropdown-item>
            <b-dropdown-item to="/register">
              <span class="text-dark">Εγγραφή</span>
            </b-dropdown-item>
          </span>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>
<script>
        export default {
                props: ['loggedin', 'user'],

                data(){
                  return{
                      pending:0,
                      searchInputValue: ''
                  }
                },

                methods: {
                  toAdminPanel () {
                    window.location.replace('/admin')
                  },
                  handleSubmit() {
                    // Change the router's view programmatically
                    this.$router.push({ path: '/p' , query: { search: this.searchInputValue } });
                  },
                  logout() {
                      axios.post('/api/vuelogout').then((response) => {
                          localStorage.setItem('user', null)
                          location.replace('/home');
                      });
                    },
                  getPendingPosts(){ 
                      axios.get('/api/vue/toverificate').then((response) => {
                                  
                                this.pending = Object.keys(response.data).length;
                          })
                  },
                },
                created(){ 
                    this.getPendingPosts();
                  },
                computed:{
                  profileImage() {
                    return (this.user && this.user.profile_image) ? this.user.profile_image : false;
                  },
                  isPostPage() {
                    return this.$route.path === '/p';
                  },
                  checkPost(){
                    this.getPendingPosts();
                    return 'updated';
                  } 
                }
                
        }  
</script>