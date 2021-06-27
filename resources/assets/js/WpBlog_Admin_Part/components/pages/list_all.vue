<template>
	<div class="services">
		<h1>{{title}}</h1>
		<p>
			

		</p>
        
        <!-- V loop over ajax success data -->
        <div v-for="(postAdmin, i) in booksGet" :key=i class="col-sm-12 col-xs-12 oneAdminPost"> 
            <p>{{postAdmin.wpBlog_title}}</p>
            <p>{{ truncateText(postAdmin.wpBlog_text) }}</p>
            
            <!-- Image with LightBox -->
	        <a v-if="postAdmin.get_images.length" :href="`images/wpressImages/${postAdmin.get_images[0].wpImStock_name}`"   title="image" :data-lightbox="`roadtrip${postAdmin.wpBlog_id}`" > <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
                <img v-if="postAdmin.get_images.length" class="card-img-top my-adm-img" :src="`images/wpressImages/${postAdmin.get_images[0].wpImStock_name}`" />
	        </a>
            <!-- End Image with LightBox -->
		
            <!-- If image does not exist. ELSE -->
            <img v-else class="card-img-top my-img" :src="`images/no-image-found.png`" />
            
            <!-- Edit/Delet Buttons --> 
            <hr>            
            <p>  
                <button style="font-size:19px" class="btn btn-success">Edit   <i class="fa fa-pencil"></i></button>
                <button style="font-size:19px" class="btn btn-danger"> Delete <i class="fa fa-trash-o"></i></button>
            </p>
        </div>
        <!-- End V loop over ajax success data -->
        
	</div>
</template>

<script>
    import { mapState } from 'vuex';
	export default{
		name:'blog',
		data (){
			return{
				title:'List all blog entries',
                ajaxList: [], //[{wpBlog_title:'bl', wpBlog_text:'bl-text'}, {wpBlog_title:'bl2', wpBlog_text:'bl-text2'}],
			}
		},
        
        
        computed: {
            //...mapState(['ajaxList']),
            booksGet() { //make reactive ajax response 
                return this.ajaxList;
            }
           
        },
        
        
        beforeMount() { 
            let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta tag with csrf
            //alert(token.content);
	        this.tokenXX = token.content; //gets csrf token and sets it to data.tokenXX
            this.runAjaxToGetPosts();
        }, 
        
        
        methods: {
            runAjaxToGetPosts(/*{ commit, state  }*/) {
               
               
                var that = this;
                alert('go');
                $('.loader-x').fadeIn(800); //show loader
               
                //Add Bearer token to headers
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + this.$store.state.api_tokenY
                    }
                }); 
      
		        $.ajax({
		            url: 'api/post/admin_get_all_blog', 
                    type: 'GET', //
            
            cache : false,
            dataType    : 'json',
            processData : false,
            contentType: false,
            //contentType:"application/json; charset=utf-8",						  
            //contentType: 'application/x-www-form-urlencoded; charset=utf-8',
            //contentType: 'multipart/form-data',

			//crossDomain: true,
			//headers: {'Content-Type': 'application/x-www-form-urlencoded', 'Authorization': 'Bearer ' + this.$store.state.api_tokenY},
            //headers: { 'Content-Type': 'application/json',  },
			//contentType: false,
			//dataType: 'json', //In Laravel causes crash!!!!!// without this it returned string(that can be alerted), now it returns object
           
			//passing the data
            data: {  _token: this.tokenXX, }, //csrf token, though here is not required
		    
            success: function(data) {
                alert("success");            
                alert("success" + JSON.stringify(data, null, 4));
                
                if(data.error == true ){ //if Rest endpoint returns any predefined error
                    var text = data.data;
                    swal("Check", text, "error");
              
                  
                } else if(data.error == false){
                    //return commit('setPosts', data ); //sets ajax results to store via mutation
                    that.ajaxList = data.data; 
                    console.log("LISTT1: " + data.data);
                    console.log("LISTTT: " + that.ajaxList[0].wpBlog_title);
                    var tempoArray = []; 
                    swal("Good", "Bearer Token is OK", "success");
                    swal("Good",  data.data, "success");
                }
                $('.loader-x').fadeOut(800); //show loader
            },  //end success
            
			error: function (errorZ) {
                alert("Crashed"); 
			    alert("error" +  JSON.stringify(errorZ, null, 4));
                console.log(errorZ.responseText);
                console.log(errorZ);
                
                /*
                if (errorZ.status == 422) {
                    swal("Error", "Validation crashed", "error");  
                }*/
                
                if(errorZ.responseJSON != null){
                    if(errorZ.responseJSON.error == true || errorZ.responseJSON.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                       swal("Error: Unauthenticated", "Check Bearer Token", "error");  
                      //alert("Unauthenticated");                  
                    } 
                }
                swal("Error", "Something crashed", "error");  
                $('.loader-x').fadeOut(800); //show loader
                
			}	  
            });                             
            //END AJAXed  part
            
            },
            
            
            truncateText(text) {
                if (text.length > 64) {
                    return `${text.substr(0, 64)}...`;
                }
                return text;
            },
        },
        
        
        mutations: {
            setPosts(state, response) {  alert('Set ajaxList mutation successfully');
                state.ajaxList = response.data/*.data*/;
	            console.log('setPosts executed in store' + response);
        
           } ,
        },
        
	}
</script>

<style scoped>
	
</style>