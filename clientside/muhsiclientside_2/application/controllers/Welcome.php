<?php
defined('BASEPATH') OR exit('No direct script access allowed');

set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH. '/third_party/phpseclib');
 require_once APPPATH. "/third_party/phpseclib/Net/SFTP.PHP";

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
    $fname=$_FILES["upld"]['name'];
    $ftype=$_FILES["upld"]['type'];
    $fsize=$_FILES["upld"]['size']/1024;
    $tmpfile=$_FILES['upld']['tmp_name'];
    $allowedExts=array("gif","jpeg","jpg","png");
    $etmp=explode(".",$fname);
    $extn=end($etmp);
    $validation=true;
    if(($ftype =="image/jpeg")||($ftype=="image/gif")||($ftype=="image/png")||($ftype=="image/jpg")&&in_array($extn,$allowedExts))
    {
      $response=array("Msg"=>"only accept png,jpeg","status"=>206);
      $validation=false;
    }
    elseif($fsize>=5120)
    {
      $response=array("Msg"=>"image is too large","status"=>205);
      $validation=false;  
    }
    else 
    {
        $ufile=$data['mailid'].".png";
    
    $upimage=APPPATH."upload image/".$ufile;
    move_uploaded_file($tmpfile,$upimage);
    }  
 if($validation=true)
 {
   $sftp=new Net_SFTP('13.76.212.119',22);
    if(!$sftp->login('file','file123!'))
    {
        exit('sftp login failed');
    }
      /*  $config['upload_path']=
        $config['allowed_types']='gif|jpg|png';
        $config['max_width']='500';
        $config['max_height']='500';*/
        $sftp->chdir('muhsi');
         $ufile=$data['mailid'].".png";
      //  echo $sftp->exec('ls');
       // echo $sftp->pwd();
     //  echo $upimage;
         $upimage=APPPATH."upload image/".$ufile;
        $sftp->put($ufile,file_get_contents($upimage));
        $data['propic']="13.76.212.119/muhsi/".$ufile;


   // print_r($data);
    $url = 'http://localhost/muhsiserverside/Welcome/insertuser';
   //   $url='http://api.baabtra.com/muhsiserverside/index.php/Welcome/insertuser';
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
}
 public function fblogin()
       {
           $data['email']=$this->input->get_post('email');
           $data['pass']=$this->input->get_post('pass');
              
                  
           // $url = 'http://localhost/muhsiserverside/logserve/logservevld';
		   $url='http://api.baabtra.com/muhsiserverside/index.php/logserve/logservevld';
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
		//print_r($result);
        
 
        
        $responseData['user']=$json;
       
       
    //  print_r($result);
       /* $resultData=array();
            foreach ($json as $data) {
                $resultData=$data[];
            }
            $result['user']=$resultData;
         echo $resultData;*/
 //  if(!empty($json)) {    
	foreach ($json as $key=>$val)
			{
                if($val['ResponseCode']==200)
                    $this->load->view("fbpage.html");
                else if($val['ResponseCode']==500)     
                    $this->load->view("fbpasserror.php",$responseData); 
            
			 	// echo $_SERVER['HTTP_HOST']."/images.png";
			    else if($val['ResponseCode']==404)
                    $this->load->view("fbloginfail.html");  
            }
           // }
       }       
         
}
?>