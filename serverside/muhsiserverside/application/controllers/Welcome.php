<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/
    public function insertuser()
    {
        $flag=0;
       // return $true;
        
        if(isset($_REQUEST["mailid"])&&isset($_REQUEST["passid"])&&isset($_REQUEST["fname"])&&isset($_REQUEST["sname"])&&isset($_REQUEST["dy"])&&isset($_REQUEST["mth"])&&isset($_REQUEST["yr"])&&isset($_REQUEST["gender"])&&isset($_REQUEST["rmailid"])&&isset($_REQUEST["propic"]))
        {
          // echo "reached service";
          // $errorMsg=array("msg" =>"invalid","status" =>500 );
            $data=array(
                    'email'=>$this->input->get_post('mailid'),
                    'password'=>$this->input->get_post('passid'),
                    'first_name'=>$this->input->get_post('fname'),
                    'last_name'=>$this->input->get_post('sname'),
                    'date'=>$this->input->get_post('dy'),
                    'month'=>$this->input->get_post('mth'),
                    'year'=>$this->input->get_post('yr'),
                    'gender'=>$this->input->get_post('gender'),
                                     
                   
                   );
             $data['hash']=$this->input->get_post('hash');      
             $data['profile_pic']=$this->input->get_post('propic');   
            $i=$this->input->get_post('rmailid');
            $letter="/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i";
            $passletter="/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/";
            $agey=date("Y");
            $nyear=$agey-$data['year'];
            
           if(strlen($data['first_name'])<3)
           {
               $response=array("msg"=>"firstname should be 6 characteres","status"=>204);
               $flag=1;
           }
              
           if(!preg_match($letter,$data['email']))
             {
                   // $errorMsg="msg:invalid emailid";
                  $response=array("msg" =>"invalid","status" =>500 );
                  $flag=1;
             }
            else if ($data['email']!=$i)
            {
                   // $errorMsg="msg:invalid emailid";
                  $response=array("msg" =>"email mismatch","status" =>500 );
                  $flag=1;
             }
             
           if(!preg_match($passletter,$data['password']))
             {
                    $response=array("msg"=>"Password must contain 6 characters of letters, numbers and at least one special character","status"=>204);
                    $flag=1;
           
             }
             
           if($nyear<13)
           {
                    $response=array("msg"=>"minimum age is 13 years","status"=>203);
                    $flag=1;
           }  
      
         if($flag==0)
           
             {  
                    $data['hash']=md5(rand(0,1000));
                    $data['profile_pic']=$this->input->get_post('propic'); 
                         
                    $this->load->model('Add_user');
                    $response=$this->Add_user->adduser($data);
                  
                    
                 if($response['msg']=="inserted successfully")
                    {
                        $sdmail=$this->sendmail($data['hash'],$data['email']);
                    }
             }
              // $errorMsg="msg: satisfied";
       // echo "satisfied";
      // echo $flag;
      
         }
         else
         {         // print_r($_REQUEST);
                    $response=array("msg"=>"no data recieved","status"=>201);
                   //  echo "not satisfied";
         }
         echo json_encode($response); 
         
         }
         
public function sendmail($hash,$email)
{
    $config['protocol']='smtp';
    $config['smtp_host']='ssl://smtp.googlemail.com';
    $config['smtp_port']='465';
    $config['smtp_user']='muhsi5vrn@gmail.com';
    $config['smtp_pass']='muhsina555';
    $config['mailtype']='html';
    $config['charset']='utf8';
    $config['wordwrap']=TRUE;
    $config['newline']="\r\n";
    $this->email->initialize($config);
    $this->email->from('muhsi5vrn@gmail.com','muhsina');
    $this->email->to('safnasash@gmail.com');
    $subject="email verification";
    $this->email->subject($subject);
    $msg="Please click this link to activate your account:
     http://localhost/muhsiserverside/Welcome/verify? email='.$email.'&hash='.$hash.'";
    $this->email->message($msg);
    if($this->email->send())
    {
     echo 'email send';
    } 
    else 
    {
     echo $this->email->print_debugger();   
    }
    
} 
public function verify()
{
  if(isset($_REQUEST['email'])&&isset($_REQUEST['hash']))  
  {
    
         $data['email']=$this->input->get_post('email');
         $data['hash']=$this->input->get_post('hash');
        // echo $hash;
         $this->load->model('Add_user');
         $rmsg=$this->Add_user->verifymail($data);
         print_r($rmsg);
        // $rmsg=array("msg"=>"verifydata","status"=>204);
   } 
   else 
   {
       $respmsg=array("msg"=>"Invalid approach, please use the link that has been send to your email","status"=>205);
       echo json_encode($respmsg);
   }        
    
}
}
?>