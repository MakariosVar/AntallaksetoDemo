<template>
         <div class="container"  >
		<div v-if="!(this.Loaded)" class="pageMinFit d-flex">
			<PreLoader ></PreLoader>
		</div> 
        	<div v-else class="col m-2 justify-content-center rounded pageMinFit">
 
                                <h1 class="text-center">MHNYMATA</h1> 
                                        <div v-if="!(messages[0])" class="col text-center">
                                                <h2> Κανένα Μήνυμα</h2>
                                          
					
						<router-link class="h2" to="/home">Επιστροφή στην αρχική </router-link>
						
						 
              
					
                                        </div>
					<div v-else v-for="message in messages" :key="message.id" class="row d-flex m-2 u-border-1  nowrap w-100 justify-content-center">
						 
						<div class="w-100" style="position: relative; max-width: 700px;">
                                                        <p class="small"><small>{{ message.date }}</small></p>
							
							<p class="postText"> <strong>{{ message.name}}</strong></p>

							

							<p class="postText"><small><strong> Email  : </strong>{{ message.email }}</small></p>
						
							<p class="postText"><small><strong>Θέμα  :</strong> {{ message.subject }}</small></p>
							<p class="postText h4"><small><strong>Μήνυμα  :</strong> {{ message.message }}</small></p>
							
						
							    
							 
						</div> 
									
                                                <form  class="d-flex align-items-center" v-if="user.role_id != 2" @submit.prevent="DeleteMessage(message.id)"> 
							<div class="text-center">
								<button type="submit" class="btn btn-outline-danger btn-sm ml-3">Διαγραφή Mηνύματος</button>
							</div>
						</form>  
 
						
                        		</div> 
		</div> 
        	
                 
  
	</div>
</template>
<script>

export default {
        props:['user'],

        data(){
                return{
                        messages:{},
                        Loaded:false,
                        
                }
        },
        methods:{
                getMessages(){
                        axios.get('/api/getmessages').then((repsonse) =>{
                                this.messages = repsonse.data;
                                this.Loaded = true;
                        })
                }, 
                DeleteMessage(param){
                        

                        if (confirm("Πατόντας ΟΚ το μήνυμα θα διαγραφεί, είστε σίγουροι;") == true) {
			        axios.post('/api/deleteMessage/'+param).then((response) => {
				        if(response.data.status == "success"){
                                                this.getMessages();
                                        }
                                });
                        }
                        		
		} 
        },
        created(){
                this.getMessages();
        }

}
</script>
