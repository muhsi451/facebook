<?php 
class Logserve extends CI_Controller
{
    public function logservevld()
    {
      if(isset($_REQUEST["email"])&&isset($_REQUEST["pass"]))
      {
         $user=array(
            'email'=>$this->input->get_post('email'),
            'password'=>$this->input->get_post('pass'),
           // 'hash'=>$this->input->get_post('hash'),
            
         );
            $this->load->model('Add_user');
            $usr=$this->Add_user->selectuser($user);
            print_r($usr);
      
    }
    else {
          $response=array("msg"=>"no data recieved","status"=>201);
           echo json_encode($response); 
           //echo "no data";
    }
    
}
}
?>     
            
            
            
            
          
      