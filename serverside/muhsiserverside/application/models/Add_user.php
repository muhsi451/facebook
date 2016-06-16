<?php
class Add_user extends CI_Model
{
function adduser($USER)
{
      foreach(array_keys($USER) as $j)
	  $USER[$j]=$this->db->escape($USER[$j]);
      $value=implode(',',$USER);
     // $this->db->query("call regstrn({$value})");
	 if($this->db->query("call regstrn({$value})"))
     {
       $response=array("msg"=>"inserted successfully");  
     }
     else
       $response=array("msg"=>"error");  
     
		   
     // $this->db->insert('user',$USER);
    
    //$this->db->insert('user',array('firstname'=>$a,'surename'=>$b));
     //$this->db->insert('user',);
   // $response=array("msg"=>"successfull","status"=>200); 
    return $response;
    
   // print_r($response);
     
}

function verifymail($data)
{
    $data['active']=0;
    
    $this->db->select('email','hash','active');
    $this->db->from('login');
    $this->db->where($data);
    $query=$this->db->get();
    //print_r($query);
   // $a=$query->num_rows();
    // echo $a;
    //$query="select email,hash,active from login where mailid='".$email."' AND hash='".$hash."' AND active='0'";
     //$match=mysql_num_rows($search);
    // echo $match;
  if($query->num_rows()==1)
     {
        // $rmsg=array();
         $this->db->set('active',1,false);
         $this->db->where($data);
         $this->db->update('login');
         $rmsg[0]['msg']="Your account has been activated, you can now login";
         
       // $udt=("update login set active='1' where mailid='".$email."' AND hash='".$hash."' AND active='0'") ; 
     }
     else
     {
          $rmsg[0]['msg']="The url is either invalid or you already have activated your account";
     }
     return json_encode($rmsg);
 }
       

function selectuser($data)
{
  
    /*$email=$data['email'];
    $password=$data['pass'];
    $hash=$data['hash'];*/
   //print_r($response);  
    
    $mail=$data['email'];
    $this->db->select('*');
    $this->db->from('login');
    $this->db->join('user','login_id=fk_login_id');
    $this->db->where($data);
    $query=$this->db->get();
     
        //  $eid=$this->input->get_post('mailid');
         // $pid=$this->input->get_post('passid');
      
    
      if($query->num_rows()==1)
            {
                $usr=array();
                $usr[]=$query->result_array();
                $usr[0]['ResponseCode']=200;
                $usr[0]['msg']="Success";
                
                
            //$password = rand(1000,5000);
          // $sql="insert into login(email,password,hash)values('$email','$password','$hash')";
         /* $data=array(
              'email'=>$email,
              'password'=>$pass,
              'hash'=>$hash,
          );
          $this->db->insert('login', $data);*/
     /*  if(response==1)
        {
             $usr[0]['ResponseCode']=500;
             $usr[0]['msg']="activate";
        }
       else
        {
               $usr[0]['ResponseCode']=212;
               $usr[0]['msg']="already taken";
        }
        */    
              
          } 
            else
            {
               // return false;
          $qry=$this->db->query("select email,password,profile_pic from login join user on fk_login_id=login_id where email='$mail' ");
           
       if($qry->num_rows()==1)
            {
                
                $usr[]=$qry->result_array();
                $usr[0]['ResponseCode']=500;
                $usr[0]['msg']="Password Incorrect";
                
                
            }
            else
            {
                $usr[0]['ResponseCode']=404;
                $usr[0]['msg']="Email id does not exist";
               // return false;  
            }      
   
            }
            return json_encode($usr);
}
}
?>