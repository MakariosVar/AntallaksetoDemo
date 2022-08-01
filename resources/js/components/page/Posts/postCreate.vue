<template>
  <div  v-if="submit" class="pageMinFit d-flex flex-column text-center">  
  <p class="h2 loadingText"> Φόρτωση</p> 
    <PreLoader></PreLoader> 
 </div>
 <div v-else class="container p-5">  
    <form @submit="checkForm" id="CreatePost" enctype="multipart/form-data">


    <div class='row'>
        <div class="col-8 offset-2"> 
            <div class="d-flex"><h1 class="text-align-center">Προσθέστε νέα αγγελία</h1>
            </div>
                <div class="form-group row">
                    <label  for="title" class="col-md-4 col-form-label">Τίτλος</label>

                    <input  :maxlength="60" 
                            v-model="form.title"
                            id="title" 
                            type="text"
                            class="form-control" 
                            name="title"
                            autocomplete="title" 
                            autofocus
                            required> 

              
                    <span class="invalid-feedback" role="alert">
                        <strong> message </strong>
                    </span>
                  
                
                </div>   
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Περιγραφή </label>

                    <input  :maxlength="300"
                            v-model="form.description"
                            id="description" 
                            type="text"
                            class="form-control" 
                            name="description"
                            autocomplete="description" 
                            autofocus
                            required>

                    
                    <span class="invalid-feedback" role="alert">
                        <strong> message </strong>
                    </span>
                   
                
                </div>   
                <div class="form-group row">
                    <label for="adlocation" class="col-md-4 col-form-label">Τοποθεσία</label>

                    <input  v-model="form.adlocation"
                            id="adlocation" 
                            type="text"
                            class="form-control" 
                            name="adlocation"
                            autocomplete="adlocation" 
                            autofocus
                            :maxlength="60"
                            required>

                   
                    <span class="invalid-feedback" role="alert">
                        <strong> message </strong>
                    </span>
                
                 
                </div>  
                  <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label">Κατηγορία</label>
                        <select v-model="form.category" id="category" name="category" aria-label="category">
                            <option value="Διάφορα" selected>Διάφορα</option>
                            <option v-for="category in categories" :v-if="category.title != 'Διάφορα'" v-bind:key="category.id"  :value="category.title">{{ category.title }}</option>
                        </select> 
                      </div> 
                <div class="form-group row">
                    <label for="condition" class="col-md-4 col-form-label">Κατάσταση</label>

                        <select v-model="form.condition" id="condition" name="condition" >
                            <option value="Καινούριο">Καινούριο</option>
                            <option value="Μεταχειρισμένο" selected>Μεταχειρισμένο</option>
                            <option value="Με φθορές">Με φθορές</option>
                        </select>
                </div> 
                
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">Τηλέφωνο Επικοινωνίας</label>

                    <input  :maxlength="10"
                            v-on:keypress="NumbersOnly"
                            v-model="form.phone"
                            id="phone" 
                            type="text"
                            class="form-control" 
                            name="phone"
                            autocomplete="phone" 
                            autofocus
                            required>

               
                    <span class="invalid-feedback" role="alert">
                        <strong> message </strong>
                    </span>
                    
                
                </div>  
                <div class="form-group row">
                    <label for="transferPref" class="col-md-4 col-form-label">Προτίμηση Ανταλλαγής</label>

                    <input  :maxlength="300"
                            v-model="form.transferPref"
                            id="transferPref" 
                            type="text"
                            class="form-control" 
                            name="transferPref"
                            autocomplete="transferPref" 
                            autofocus
                            required> 

                    <span class="invalid-feedback" role="alert">
                        <strong> message </strong>
                    </span>

        
                </div> 

                <div class="form-group row">
                        <input v-model="form.premium" type="checkbox" class="form-check-input form-control" name="premium" value="0" id="premium">
                        <label for="premium"> Προωθημένη Αγγελία [DEMO FREE] </label><br>
                </div>
                 <div class="text-center">
                <h2>Φωτογραφίες</h2>
                <p>*Απαραίτητη Τουλάχιστον μια (1) φωτογραφία</p>
                </div>
                <div class="row justify-content-center">   
               <!-- IMAGE 0-->  
                                
                                    
                                        <div class="pic-holder">
                                                 <img v-if="this.NewImageLoad0" id="profilePic0" class="pic" style="min-width: 100%;">         

                                                        <div v-else class="d-flex flex-column align-items-center">
                                                                <img src="/images/ImageRequire1.svg" style="min-width:180px;">
                                                               
                                                        </div>    
                                                        <Input  @change="image0" class="uploadProfileInput1" type="file" name="image" id="newProfilePhoto1" accept="image/*"   />
                                                        <label for="newProfilePhoto1" class="upload-file-block">
                                                                
                     
                                                                <div class="text-center">
                                                                        <div class="mb-2">
                                                                                <i class="fa fa-camera fa-2x"></i>
                                                                        </div>  
 
                                                                        <div class="text-uppercase">
                                                                                Νέα Φωτογραφία <br /> No. 1 
                                                                        </div>
                                                                </div> 
                                                        </label> 
                                        </div>
                                      
                                <!-- IMAGE 1 -->
                                        <div class="pic-holder">
                                                        <img v-if="this.NewImageLoad1" id="profilePic1" class="pic" style="min-width: 100%;">         
                                                   
                                                        <div v-else class="d-flex flex-column align-items-center">
                                                        
                                                                        
                                                        <svg width="150px" height="150px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs></defs><title>number--2</title><path d="M20,23H12V17a2,2,0,0,1,2-2h4V11H12V9h6a2,2,0,0,1,2,2v4a2,2,0,0,1-2,2H14v4h6Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                                         </div>   
                                                        <Input  @change="image1" class="uploadProfileInput2" type="file" name="image" id="newProfilePhoto2" accept="image/*"   />
                                                        <label for="newProfilePhoto2" class="upload-file-block">
                                                                
                     
                                                                <div class="text-center">
                                                                        <div class="mb-2">
                                                                                <i class="fa fa-camera fa-2x"></i>
                                                                        </div>  
 
                                                                        <div class="text-uppercase">
                                                                                Νέα Φωτογραφία <br /> No. 2
                                                                        </div>
                                                                </div>
                                                        </label>
                                        </div>
                
                                <!-- IMAGE 2--> 
                                        <div class="pic-holder">
                                                        <img v-if="this.NewImageLoad2" id="profilePic2" class="pic" style="min-width: 100%;">         
                                                    
                                                        <div v-else class="d-flex flex-column align-items-center">
                                                               
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 32 32" id="icon" data-arp-injected="true"><defs></defs><title>number--3</title><path d="M18,9H12v2h6v4H14v2h4v4H12v2h6a2,2,0,0,0,2-2V11A2,2,0,0,0,18,9Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                                        </div>   
                                                        <Input  @change="image2" class="uploadProfileInput3" type="file" name="image" id="newProfilePhoto3" accept="image/*"   />
                                                        <label for="newProfilePhoto3" class="upload-file-block">
                                                                
                     
                                                                <div class="text-center">
                                                                        <div class="mb-2">
                                                                                <i class="fa fa-camera fa-2x"></i>
                                                                        </div>  
 
                                                                        <div class="text-uppercase">
                                                                                Νέα Φωτογραφία <br /> No. 3
                                                                        </div>
                                                                </div>
                                                        </label>
                                        </div>
                                <!-- IMAGE 3--> 
                                        <div class="pic-holder">
                                                        <img v-if="this.NewImageLoad3" id="profilePic3" class="pic" style="min-width: 100%;">         
                                                   
                                                        <div v-else class="d-flex flex-column align-items-center">
                                                          
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 32 32" id="icon" data-arp-injected="true"><defs></defs><title>number--4</title><path d="M18,10v8h0V10m1-1H17v8H14V9H12V19h5v4h2V19h1V17H19V9Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-2" width="32" height="32"/></svg>

                                                         </div>   
                                                        <Input  @change="image3" class="uploadProfileInput4" type="file" name="image" id="newProfilePhoto4" accept="image/*"   />
                                                        <label for="newProfilePhoto4" class="upload-file-block">
                                                                
                     
                                                                <div class="text-center">
                                                                        <div class="mb-2">
                                                                                <i class="fa fa-camera fa-2x"></i>
                                                                        </div>  
 
                                                                        <div class="text-uppercase">
                                                                                Νέα Φωτογραφία <br /> No. 4
                                                                        </div>
                                                                </div>
                                                        </label>
                                        </div>
                                <!-- IMAGE 4--> 
                                        <div class="pic-holder">
                                                        <img v-if="this.NewImageLoad4" id="profilePic4" class="pic" style="min-width: 100%;">         
                                                   
                                                        <div v-else class="d-flex flex-column align-items-center">


                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="150px" height="150px" viewBox="0 0 32 32" id="icon" data-arp-injected="true"><defs></defs><title>number--5</title><path d="M18,23H12V21h6V17H12V9h8v2H14v4h4a2,2,0,0,1,2,2v4A2,2,0,0,1,18,23Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                                         
                                                         
                                                         </div>   
                                                        <Input  @change="image4" class="uploadProfileInput5" type="file" name="image" id="newProfilePhoto5" accept="image/*"   />
                                                        <label for="newProfilePhoto5" class="upload-file-block">
                                                                
                     
                                                                <div class="text-center">
                                                                        <div class="mb-2">
                                                                                <i class="fa fa-camera fa-2x"></i>
                                                                        </div>  
 
                                                                        <div class="text-uppercase">
                                                                                Νέα Φωτογραφία <br /> No. 5
                                                                        </div>
                                                                </div> 
                                                        </label>
                                       
                                        </div> 
                    
                        </div>
                <div class="row pt-4 justify-content-center">
                    <button type="submit" class="btn btn-primary">Εκχώρηση</button>
                </div> 
            </div>
        </div>
    </form>
</div>
           

</template>

<script>
        export default {
        data(){
            return{
            form: {
                title: '',
                description: '',
                adlocation: '',
                category: 'Διάφορα',
                condition: 'Μεταχειρισμένο',
                phone: '',
                transferPref: '',
                premium: '',
                image0: null,
                image1: null,
                image3: null,
                image2: null,
                image4: null,
                },
                categories: {},
                submit:false,
                NewImageLoad0:false,
                NewImageLoad1:false,
                NewImageLoad2:false,
                NewImageLoad3:false,
                NewImageLoad4:false
           
            }
    }   ,
        mounted() {
           
        },
        
        methods:{
        image0:
                                        function (e){          
                                                var files = e.target.files[0];
                                                this.form.image0 = files; 
                                                
                                                var reader = new FileReader();
                               
                                                reader.onload = function(){
                                                        var profilePic = document.getElementById('profilePic0');
                                                        profilePic.src = reader.result;
                                                };

                                                reader.readAsDataURL(this.form.image0);
  
                                                this.NewImageLoad0 = true;
                                        },
                                image1:
                                        function (e){
                                                var files = e.target.files[0];
                                                this.form.image1 = files;  
                                        
                                                var reader = new FileReader();
                               
                                                reader.onload = function(){
                                                        var profilePic = document.getElementById('profilePic1');
                                                        profilePic.src = reader.result;
                                                };

                                                reader.readAsDataURL(this.form.image1);
  
                                                this.NewImageLoad1 = true;
                                        
                                        
                                        },
                                image2:
                                        function (e){
                                            var files = e.target.files[0];
                                            this.form.image2 = files;  
                                            
                                                var reader = new FileReader();
                               
                                                reader.onload = function(){
                                                        var profilePic = document.getElementById('profilePic2');
                                                        profilePic.src = reader.result;
                                                };

                                                reader.readAsDataURL(this.form.image2);
  
                                                this.NewImageLoad2 = true;
                                        },
                                image3:
                                        function (e){
                                            var files = e.target.files[0];
                                            this.form.image3 = files;
                                            
                                                var reader = new FileReader();
                               
                                                reader.onload = function(){
                                                        var profilePic = document.getElementById('profilePic3');
                                                        profilePic.src = reader.result;
                                                };

                                                reader.readAsDataURL(this.form.image3);
  
                                                this.NewImageLoad3 = true;
                                        },
                                image4:
                                        function (e){
                                            var files = e.target.files[0];
                                            this.form.image4 = files;  
                                            
                                                var reader = new FileReader();
                               
                                                reader.onload = function(){
                                                        var profilePic = document.getElementById('profilePic4');
                                                        profilePic.src = reader.result;
                                                };

                                                reader.readAsDataURL(this.form.image4);
  
                                                this.NewImageLoad4 = true;
                                        }, 
        checkForm: 
                function (e) { 
                        
                        this.submit = true;
                        let data = new FormData();
                        data.append('title', this.form.title);
                        data.append('description', this.form.description);
                        data.append('adlocation', this.form.adlocation);
                        data.append('category', this.form.category);
                        data.append('condition', this.form.condition);
                        data.append('phone', this.form.phone);
                        data.append('transferPref', this.form.transferPref);
                        data.append('premium', this.form.premium);
                        data.append('image0', this.form.image0); 

                        if(this.form.image1 != null){data.append('image1', this.form.image1);}
                            
                        if(this.form.image2 != null){data.append('image2', this.form.image2);}
                            
                        if(this.form.image3 != null){data.append('image3', this.form.image3);}
                            
                        if(this.form.image4 != null){data.append('image4', this.form.image4);}
                        
                        let user = this.$attrs.user 
                          
                     
                        axios.post('/api/p/store', data).then((response) => {  
                            
                                this.$router.push('/myposts/'+user.id)
                                    
                     
                            },   
                            function()  
                            {
                                console.log('failed');
                                alert('\n\nΚάτι πήγε στραβά \n\n\n Ελέγξτε τα στοιχεία που έχετε καταχωρήσει και προσπαθήστε ξανά')
                            });
                            this.form.phone = '';
							this.submit=false;  
                            e.preventDefault();
               
                },
                getCategories(){
                        axios.get('/api/vue/categories').then((response) => {
                                this.categories = response.data
                        });
                },
                NumbersOnly(evt) {
                            evt = (evt) ? evt : window.event;
                            var charCode = (evt.which) ? evt.which : evt.keyCode;
                            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                                evt.preventDefault();;
                            } else {
                                    return true;
                            }
                }
        },
        created(){
            this.getCategories()
                    
              
                }
    }
</script>