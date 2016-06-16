<?php 
class Upload extends CI_Controller
{
function uploadprof()
{
    $this->load->library('sftp/SFTP');
    $config['hostname'] = '13.76.209.156';
    $config['username'] = 'phpservice';
    $config['password'] = 'phpservice1!';

   // $this->SFTP->connect($config);
  //  $this->SFTP->upload('E:\images', '/var/www/Sashuploads', 'ascii', 0775);
  //  $this->SFTP->close();

    echo $this->sftp->connect($config);
   /* {
         echo 'success';
    }
    else
     {
        echo 'not success';
    }*/
     $this->sftp->upload('E:\images', '/var/www/Sashuploads');
    $this->sftp->close();
}
    
}