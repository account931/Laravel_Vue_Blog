<!-- Edit an article (in SAdmin section) -->
<template>

	<div class="services">
		<h1>{{pageTitle}} number <b> {{this.currentDetailID}}</b></h1>
        
        <!-- Nav Link go back -->
		<p class="z-overlay-fix-2"> 
            <router-link class="nav-link" to="/list_all">
                <i class="fa fa-tag" style="font-size:24px"></i>
                <button class="btn"> Back to List of all <i class="fa fa-tag" style="font-size:14px"></i></button>
            </router-link>
        </p>

        
        <!-- V loop over ajax success data -->
        <p> You are editing item with title:  <i class="text-danger"><b> {{this.inputTitleValue}}  </b></i></p>
        <!-- End V loop over ajax success data -->
        
        
        <!-- Display Loaded images -->
        <div v-for="(imageXX, i) in imggGet " :key="i" class="alert alert-success"> 
            <div class="col-sm-12 col-xs-12"  v-if="i  == 0"> <p> Item's images </p></div>
            <img v-if="imggGet.length" class="card-img-top my-adm-img" :src="`images/wpressImages/${imageXX.nameN}`"/>
            <button style="font-size:11px" class="btn btn-danger"  @click="deleteDBImage(imageXX)"> Delete <i class="fa fa-trash-o"></i></button>

        </div>
        
       
      
        <!------- INJECTED ------->
        <div class="card-body">
        <div v-if="status_msg" :class="{ 'alert-success': status, 'alert-danger': !status }" class="alert" role="alert">
            {{ status_msg }}
        </div>
        
	  
        <!-- Display Validation errors if any come from Controller Request Php validator -->   
        <div v-for="(book, i) in ValidorErrorGet " :key="i" class="alert alert-danger"> 
            Error: {{ book }} 
        </div>
        
        
	    
	  
      <form id="myFormZZ">
	    <input type="hidden" name="_token" :value="tokenXX" /> <!-- csfr token -->
		<!--<input type="hidden" name="_token" value="4gyBcsEYlPibNHfhi1r55rRQAZkBWepxCmVLlqAW" />-->
		
		<!-- Title -->
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input id="title" type="text" class="form-control" placeholder="Post Title" v-model="inputTitleValue" required>
        </div>
        
        <!-- Body -->
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Post Content</label>
          <textarea id="post-content" v-model="inputBodyValue" class="form-control" rows="3" required />
        </div>
        
        
        <!-- Select category -->
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Category</label>
        
            <select name="category_sel" class="mdb-select md-form" v-model="inputSelectV">
				<option  disabled="disabled"  selected="selected">Choose category</option>
                <!-- Loop -->
				<option v-for="(book, i) in this.categoriesList " :key="i" :value="book.wpCategory_id"  > {{ book.wpCategory_name}} </option>
		    </select>
		</div>
        <!--  END Select category -->
        
        
        <div class>
           
          <!-- Element-UI Upload element (contains "+" button to add new image and contains thumbnails views of loaded images) -->
          <!--ref="upload" is used to fire  clearFiles() in <el-upload> on ajax success -->
          <el-upload
              action="https://jsonplaceholder.typicode.com/posts/"
              ref="upload" 
              list-type="picture-card"
              :on-preview="handlePictureCardPreview"
              :on-remove="handleRemove"
              :before-remove="beforeRemove"
              :on-change="updateImageList"
              :auto-upload="false"
          >
              <i class="el-icon-plus" />
          </el-upload>
          
          <!-- Element-UI Preview Uploaded element (if u hover over it, there appears "+"/"delete" icons, if u click "+" icon the full-screen image pop-up'll emerge, pop-up is hidden by dafault) -->
          <el-dialog :visible.sync="dialogVisible">
            <img width="100%" :src="dialogImageUrl" alt>
          </el-dialog>
          
        </div>
      </form>
    </div>
    <div class="card-footer">
    
      <!--Button to submit -->
      <button
        type="button"
        class="btn btn-success"
        @click="editOnePost"
      >
        {{ isCreatingPost ? "Updating..." : "Start Post Updating " }}
      </button>
      
      <!--Button to clear the fields -->
      <button type="button" class="btn btn-success" @click="clearInputFieldsAndFiles">
        Clear
      </button>
      
    </div>
  </div>
  
  
   
   <!-- INJECTED -->
  
  
  
     
       
        
  
	</div>
</template>

<script>
    import { mapState } from 'vuex';
	export default{
		name:'edit-one-item',
		data (){ 
			return{
				pageTitle:'Edit one item',
                inputTitleValue: '',  //contains loaded edited item's title (from DB) //form input "Title"
                inputBodyValue: '',   //edited item's body (from DB) //form input "Body"
                inputSelectV: '',     //form input <select> value
                ajaxOneItem: [], //One item/blog data to be used in edit form (filled with ajax) /*[{wpBlog_title:'bl', wpBlog_text:'bl-text', wpBlog_author:1, get_images:[{wpImStock_id:56, wpImStock_name:"product2.png"}] ],*/
			    currentDetailID: 0, //Id of edited blog (filled with ajax)
                tokenXX:'', //csrf token
                imageList: [], //store form uploaded images
                isCreatingPost: false, //flag for button text
                dialogVisible: false, //flag
                dialogImageUrl: [{uid: 1625318532554, name: "2254.png", size: 30871, type:"image/png", uid: 1625318532554, lastModified: 1613050553593}], //'',   //contains images to display as loaded
                status_msg: '',
                status: '',
                errroList: ['validation error: None'], //list of validations errors of server-side validator
                inputImagesValueX: [],   // item/post/blogs's images (which is being now edited,loaded from DB) // [{idN: 1, nameN: '1.png'}, {id: 2, name: '2.png'}]
                oldImagesID_to_delete: [],       //array of images's IDs to delete while updateing the blog post (i.e User clicks "Delete image" on an image loaded from DB (while editing)), e.g [2, 56, 76] . On Server comes as string (???)
                categoriesList: [], //contains Categories from DB (loaded with ajax)

            }
		},
        
        
        computed: {
            
            ValidorErrorGet() { //make reactive ajax response 
                return this.errroList;
            },
            
            //Not used???
            booksGet() { //make reactive ajax response 
                return this.ajaxOneItem;
            },
            //images already loaded to DB
            imggGet() { //make reactive ajax response 
                return this.inputImagesValueX;
            }
           
        },
        
        
        beforeMount() {
            //getting route ID => e.g "wpBlogVueFrameWork#/details/2", gets 2. {Pid} is set in 'pages/home' in => this.$router.push({name:'details',params:{Pid:proId}})
	        var ID = this.$route.params.PidMyID; //gets 2
	        this.currentDetailID = ID; // 
            console.log("Editing ID is " + this.currentDetailID);
            
            //get the csrf token
            let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta tag with csrf
            this.tokenXX = token.content; //gets csrf token and sets it to data.tokenXX
            
             
            
            //run ajax to get One item
            this.runAjaxToGetOneItem(this.currentDetailID); 
            
            this.getAjaxCategories(); //get /GET all DB table categories (to build <select> in loadnew.vue)            
        }, 
        
        
        methods: {
        
            // ------ Element-UI Upload element METHODS ----------
    
            //on adding new image to form, do update array {this.imageList} (used to store all form uploaded images & appended to form)
            updateImageList (file) {
                this.imageList.push(file.raw);
                console.log(this.imageList);
            },
	
            //if u click "Preview" icon in Element-UI image Layout
            handlePictureCardPreview (file) {
                this.dialogImageUrl = file.url;
                //this.imageList.push(file); //THIS WAS INCORRECT????
                this.dialogVisible = true;//show pop-up with image
            },
    
            //if u click "Delete" icon in Element-UI image Layout
            handleRemove(file){
                alert("Delete " + file.uid); //https://www.programmersought.com/article/73755547037/
        
                for(var i = 0; i < this.imageList.length; i++){
                    if(file.uid == this.imageList[i].uid){
                        this.imageList.splice(i, 1);
                    }
                }
        
                console.log(this.imageList);
            },
    
            beforeRemove(file){
                //some stuff
            },
	
            // ------ End Element-UI Upload element METHODS ----------
            
            
           
            /*
            |--------------------------------------------------------------------------
            | When user clicks to Delete an image (images loaded from DB)
            |--------------------------------------------------------------------------
            |
            |
            */
            deleteDBImage(imageName){
                alert("ID: " + imageName.idN + " Name: " + imageName.nameN );
                //implement updating images List to append
                
                //Find an array element clicked by imageName.id 
                var arrEll;
                for(var i = 0; i < this.inputImagesValueX.length; i++){
                    if(this.inputImagesValueX[i].idN == imageName.idN){
                        arrEll = i;
                        this.oldImagesID_to_delete.push(imageName.idN); //adds image ID to array (image to be deleted onserver-side)
                    }
                }
                alert("Delete image " + arrEll );
                 //remove clicked elemenent from this.inputImagesValueX
                 
                //remove the clicked element from this.inputImagesValueX and therefore reactively remove it from UI displaying it in List of prev loader images
                this.inputImagesValueX.splice(arrEll, 1);
                console.log("Image removed " + this.inputImagesValueX);
                console.log("Array of Images ID to be removed " + this.oldImagesID_to_delete);
            },
            
            
            /*
            |--------------------------------------------------------------------------
            | When user clicks "Edit on some item" , i.e fires ajax to get 1 item data (to be used in edit/update form) via /GET 
            |--------------------------------------------------------------------------
            |
            |
            */
            runAjaxToGetOneItem(idZ) {     
                var that = this; //to fix context issue
                console.log('start one');
                $('.loader-x').fadeIn(800); //show loader
               
                //Add Bearer token to headers
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + this.$store.state.api_tokenY
                    }
                }); 
      
		        $.ajax({
		            url: 'api/post/admin_get_one_blog/' + idZ , 
                    type: 'GET', //
            
                    cache : false,
                    dataType    : 'json',
                    processData : false,
                    contentType: false,
                    //contentType:"application/json; charset=utf-8",						  
                    //contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                    //contentType: 'multipart/form-data',

			
			        //passing the data
                    //data: {  _token: this.tokenXX, }, //csrf token, though here is not required
		    
                    success: function(data) {
                        console.log("Successfully loaded data for edited article");            
                        console.log("Loaded Edited data is: " + JSON.stringify(data, null, 4));
                
                        if(data.error == true ){ //if Rest endpoint returns any predefined error
                            var text = data.data;
                            swal("Check", text, "error");
              
                        //if OK
                        } else if(data.error == false){
                            //return commit('setPosts', data ); //sets ajax results to store via mutation
                            that.ajaxOneItem = data.data; 
                            that.inputTitleValue = data.data[0].wpBlog_title;     //gets and sets DB blog title to input
                            that.inputBodyValue  = data.data[0].wpBlog_text;      //gets and sets DB blog text to input
                            that.inputSelectV    = data.data[0].wpBlog_category;  //gets and sets DB blog category to <select>
                            
                            //adding images loaded from DB
                            $.each(data.data[0].get_images, function (key, imageV) {
                                that.dialogImageUrl   = "images/wpressImages/" + imageV.wpImStock_name;
                                //var b = /*"images/wpressImages/" +*/ imageV.wpImStock_name;
                                var im = {nameN: imageV.wpImStock_name , idN: imageV.wpImStock_id};
                                that.inputImagesValueX.push(im); 
                            });
                            //that.dialogVisible = true;
                            console.log(that.dialogImageUrl);
                            console.log("imVal " + that.inputImagesValueX);                            
                            
                            console.log("LISTT1: " + data.data);
                            var tempoArray = []; 
                            swal("Good", "Bearer Token is OK", "success");
                            swal("Good", "Data for Article " + data.data[0].wpBlog_id +  " is loaded" /*data.data*/, "success");
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
                            } 
                        }
                        swal("Error", "Something crashed", "error");  
                        $('.loader-x').fadeOut(800); //hide loader
                
			        }	  
                });                             
                //END AJAXed  part
            
            },
            
            
            
            
            /*
            |--------------------------------------------------------------------------
            | When user clicks "Submit" in Edit Form, i.e fires ajax /PUT to update one post item  (via /PUT) 
            |--------------------------------------------------------------------------
            |
            |
            */
            editOnePost(e){
                e.preventDefault();
                if (!this.validateForm()) {
                    return false;
                }
                
                //alert("Updating " + this.currentDetailID);
                
                $('.loader-x').fadeIn(800); //show loader
                this.isCreatingPost = true; //flag for button text
               
                var thatX = this;
                var formData = new FormData(); //fix to load image via ajax, serialize() wont't work
                formData.append('title',         this.inputTitleValue); //adds "Title" input filed
                formData.append('body',          this.inputBodyValue);  //adds "Body" input filed
                formData.append('selectV',       this.inputSelectV);    //adds <select> input filed
                formData.append('imageToDelete', this.oldImagesID_to_delete); //append an array of old Images IDs to delete
                formData.append("_method", "PUT"); //fix for PUT method
                
                //append new uploaded images to formData
                var imagesUploaded = {};
                $.each(this.imageList, function (key, imageV) {
                    formData.append(`imagesZZZ[${key}]`, imageV);
                });
      
                console.log(this.imageList)
                
                //Add Bearer token to headers
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + this.$store.state.api_tokenY
                    }
                }); 
      
		        $.ajax({
		            url: 'api/post/admin_update_item/' + this.currentDetailID , 
                    type: 'POST', // though it is PUT, we make PUT in => formData. append("_method", "PUT")
          
                    cache : false,
                    dataType    : 'json',
                    processData : false,
                    contentType: false,

			        //passing the data
                    //data: {  _token: this.tokenXX, }, //csrf token, though here is not required (fo REST is not required)
		            data: formData,
                    success: function(data) {
                        alert("success");            
                        alert("success" + JSON.stringify(data, null, 4));
                
                        if(data.error == true ){ //if Rest API endpoint returns any predefined validation error
                            var text = data.data;
                            swal("Check", text, "error");
            
                    
                            //if validation errors (i.e if REST Contoller returns json ['error': true, 'data': 'Good, but validation crashes', 'validateErrors': title['Validation err text'],  body['Validation err text']])
                            if(data.validateErrors){
                                var tempoArray = []; //temporary array
                                for (var key in data.validateErrors) { //Object iterate
                                    var t = data.validateErrors[key][0]; //gets validation err message, e.g validateErrors.title[0]
                                    tempoArray.push(t);
                                }
                       
                                thatX.errroList = tempoArray; //change state errroList //{this-that} fix
                            }
                  
                        //if Update is OK
                        } else if(data.error == false){
                            //return commit('setPosts', data ); //sets ajax results to store via mutation
                            swal("Good", "Bearer Token is OK", "success");
                            swal({html:true, title: "Success", text: data.data, type: "success"});
                            thatX.showNotification('Updated successfully Artcicle ' + thatX.currentDetailID);
                            // Clears inputs including uploaded files
                            //thatX.clearInputFieldsAndFiles(); //don't need to clear fileds for Update

                        }
                        $('.loader-x').fadeOut(800); //hide loader
                        thatX.isCreatingPost = false; //flag for button text
                    },  //end success
            
			        error: function (errorZ) {
                        swal("Error", "Crashed", "error"); 
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
                            } 
                        }
                        swal("Error", "Something crashed", "error");  
                        $('.loader-x').fadeOut(800); //hide loader
                        thatX.isCreatingPost = false; //flag for button text
                
			        }	  
                });                             
                //END AJAXed  part
            },
            
            
            
           /*
            |--------------------------------------------------------------------------
            | GET all DB table categories (to build <select> in loadnew.vue)
            |--------------------------------------------------------------------------
            |
            |
            */
	        getAjaxCategories(){
    
                fetch('api/post/get_categories', { /*http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_categories*/
                    method: 'get',
                    //pass Bearer token in headers ()
                    headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + this.$store.state.api_tokenY },
                    //contentType: 'application/json',

   
                }).then(response => {
                    $('.loader-x').fadeOut(800);  //hide loader
                    return response.json();
                }).then(dataZ => {
                    console.log("Categories => " + dataZ); 
                    if(dataZ.error == true|| dataZ.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                        alert(dataZ.data);
                        swal("Unauthenticated", "Check Bearer Token", "error");
                  
                    } else if(dataZ.error == false){
                        swal("Done", "Categories are loaded.", "success");
                        this.categoriesList = dataZ.data;
                        console.log("Categ " + this.categoriesList[0].wpCategory_name);
                    }
                })
	            .catch(/*err => */ function(err){
                    alert("Getting categories failed. Check if u're logged =>  " + err);
                    swal("Crashed to get categories", "You are in catch", "error");
                }); // catch any error
      
            },
            
            
            
	        /*
            |--------------------------------------------------------------------------
            |Client-side form validation
            |--------------------------------------------------------------------------
            |
            |
            */
            validateForm () {
                // no vaildation for images - it is needed
                if (!this.inputTitleValue) {
                    this.status = false
                    this.showNotification('Post title cannot be empty')
                    return false
                }
                if (!this.inputBodyValue) {
                    this.status = false
                    this.showNotification('Post body cannot be empty')
                    return false
                }
      
            
                if (!this.inputSelectV) {
                    this.status = false;
                    this.showNotification('Select cannot be empty');
                    return false;
                }
      
                this.showNotification(''); //clears error messages if any
                return true;
            },
        
        
            showNotification (message) {
                this.status_msg = message;
                setTimeout(() => {  //clears message in n seconds
                    this.status_msg = ''
                }, 3000 * 155)
            },
        
            
            /*
            |--------------------------------------------------------------------------
            | Clears inputs including uploaded files
            |--------------------------------------------------------------------------
            |
            |
            */
            clearInputFieldsAndFiles(){
                this.inputTitleValue    = '';
                this.inputBodyValue     = '';
                this.inputSelectV  = '';
                this.imageList= '';
                this.$refs.upload.clearFiles(); //clears the <el-upload> uploaded files <el-upload> must contain {ref="upload"}
                        
            }
    
        },
        
        
        mutations: {
        },
        
	}
</script>

<style scoped>	
</style>