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
	public function index()
	{
		$this->load->view('facebook.html');
	}
   /* public function display()
    {
        echo 'hello world';
    }*/
public function fbregtr()
{
    $data['fname']=$this->input->get_post('fname');
    $data['sname']=$this->input->get_post('sname');
    $data['dy']=$this->input->get_post('dy');
    $data['mth']=$this->input->get_post('mth');
    $data['yr']=$this->input->get_post('yr');
    $data['gender']=$this->input->get_post('gender');
    $data['mailid']=$this->input->get_post('mailid');
    $data['passid']=$this->input->get_post('passid');
    $data['rmailid']=$this->input->get_post('rmailid');
   // print_r($data);
    $url = 'http://localhost/muhsiserverside/Welcome/insertuser';
	//$data = array('email' => 'info@baabtra.com', 'password' => 'Thisistrue');
	//use key 'http' even if you send the request to https://...

	$options = array(
    					'http' => array(
        					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        					'method'  => 'POST',
        					'content' => http_build_query($data),
    						),
    					);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$json=json_decode($result,true);
		 print_r($json);
		/*foreach ($json as $val)
			if($val['Msg']=="Success")
			 	$this->load->view("fbpage.html");
			 //	echo $_SERVER['HTTP_HOST']."/facebook/images/fb.png";
			else
				$this->load->view("fbloginfail.html");*/
                
}
 public function fblogin()
       {
           $data['email']=$this->input->get_post('email');
           $data['pass']=$this->input->get_post('pass');
              
                  
            $url = 'http://localhost/muhsiserverside/logserve/logservevld';
           // $data = array('email' => 'info@baabtra.com', 'password' => 'Thisistrue');
            
           // use key 'http' even if you send the request to https://...
		$options = array(
    					'http' => array(
        					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        					'method'  => 'POST',
        					'content' => http_build_query($data),
    						),
    					);
		$context= stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$json=json_decode($result,true);
       // echo "json";
	//	print_r($result);
        
 
        
        $responseData['user']=$result;
       
       
       // print_r($json);
       /* $resultData=array();
            foreach ($json as $data) {
                $resultData=$data[];
            }
            $result['user']=$resultData;
         echo $resultData;*/
         
	foreach ($json as $key=>$val)
			{
                if( $val['ResponseCode']==200)
                    $this->load->view("fbpage.html");
                else if($val['ResponseCode']==500)     
                    $this->load->view("fbpasserror.php",$responseData); 
            
			 	// echo $_SERVER['HTTP_HOST']."/images.png";
			    else if($val['ResponseCode']==404)
                    $this->load->view("fbloginfail.html");  
            }
       }       
         
}
?>