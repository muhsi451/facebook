<html>
   <head>
       
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->      
      <?php $this->load->helper('url');
      ?>   
   </head>
 <body>
     <form name="login" method="post" action="">
         <div class="container_fluid">
             <div class="row">
                 <div class="col-md-12" style="background-color:#3333cc">
                  <div class="col-md-12">
                      <div class="col-md-offset-2 col-md-2"> <img style="" class="image-responsive" src="<?php 
                          echo base_url('images/fbl.jpg');
                          ?>">
                      </div>
                      <div class="col-md-1">
                       <button  class="btn btn-success btn-sm" type="submit" onclick="">Signup</button>
                      </div>
                  </div>
                 </div>           
             </div>
             
             <div class="row">
                 <div class="col-md-12" style="background-color:#edf0f5">
                      <br><br><br><br><br><br> 
                    <div class="col-md-offset-4 col-md-5" style="background-color:#ffffff">
                      
                        <center><h3>Login to facebook</h3></center>
                   <input type="text" class="form-control" placeholder="email address or phone number" id="mail">  
                   <div class="col-md-0">
                   <div class="col-md-offset-0 col-md-1"><label>Username</label></div>
                  
                   <?php
                 // print_r($user);
                    
                    
                    
                    
                  foreach ($user as $usr)
                  {
                      
                  
                  ?> 
                  <div class="col-md-offset-1 col-md-8"> 
                    <img class="image-responsive" src="<?php echo $usr['profile_pic']; 
                     ?> width="40px"">
                  <label><?php 
                  echo  $usr['first_name']; 
                  ?> </label>
             
                 
                  
                    </div>
                    
                   </div></br>
           
                   <div class="col-md-0">
                  <div class="col-md-offset-1 col-md-2"><label>Password</label></div>
                   <div class="col-md-offset-0 col-md-8"><input type="text" class="form-control input-group-sm" placeholder="password" id="pass"></div>
                   </div>
                    <?php       }   
                     ?>
                   <br><br>
                    <div class=""><center><button class="btn btn-primary btn-sm" style="width:400px"type="submit" onclick="">Login</button>
                   </center></div>
                  <center> <p class=""> <a href="/about/privacy" target="_blank" rel="nofollow">Having trouble?-signup for facebook</a></p></center>
                 </div> 
                 <div class="col-md-12"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>  
                </div> </div></div>
     </form>
  </body>
</html>          