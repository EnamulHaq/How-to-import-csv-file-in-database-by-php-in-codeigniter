<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('user_model');
	        $this->load->database();
	        
	    }

	public function index()
	{
		$this->load->view('user');
	}

	function importcsv(){
		 if(isset($_FILES['file'])){

            if($_FILES['file']['tmp_name']){
                if(!$_FILES['file']['error'])
                {

                    $filename=$_FILES["file"]["tmp_name"];   
                    
                           

                        $file = fopen($filename, "r");

                        // read the first line and ignore it
                        fgets($file); 
                        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){

                            $roll          = $getData['0'];
                            $student_name  = $getData['1'];
                            $mark          = $getData['2'];
                            $comment       = $getData['3'];

                            $data = array(
                                'roll'=> $roll, 
                                'name'=>$student_name, 
                                'mark'=>$mark,
                                'comment'=>$comment
                            );
                            
                            
                            $result = $this->user_model->add($data);
  							$message_success ='<b style="color:green;">Data import successfully.</b>';
  							$message_error = '<b style="color:red;">Data import error ?</b>';
                        }
                        fclose($file);
                       
                       
				        if($result > 0)
		                {
		                    $this->session->set_flashdata('success', $message_success);
		                }
		                else
		                {
		                    $this->session->set_flashdata('error', $message_error);
		                }

		                redirect(base_url());
                        
                    }


                }else{
                    $msg = $_FILES['file']['error'];
                }
        }else{
            $msg = 'Please select CSV file !';
        }
	}


	function getdata(){
		echo 'ok';
	}



}
