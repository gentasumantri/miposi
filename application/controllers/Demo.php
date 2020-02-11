<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('M_demo');
	}
	
	public function natural_blue ($method = NULL){
		$template					= 'natural_blue';
		$data['assets'] 			= base_url('view/'.$template.'/assets/');
		$data['data']				= base_url('view/'.$template.'/data/');
		$data['link_login_theme']	= site_url('demo/'.$template.'/login');
		$data['link_logout_theme']	= site_url('demo/'.$template.'/logout');
		$status						= 'demo/'.$template.'/status';
		$login						= 'demo/'.$template.'/login';
		$data['config']				= array(
			'server-name'	=> 'igproject.net',
			'trial'			=> 'yes',
		);
		
		$this->session->theme = 'natural_blue';
		
		if ($method == "login"){
			if ($this->session->login === TRUE){
				redirect($status);
			}
			else if ($this->session->cookies === TRUE){
				$this->session->login = TRUE;
				redirect($status);
			}
			else{
				$this->M_demo->login();
			}
			$this->load->view($template."/login.php", $data);
		}
		else if ($method == "status"){
			if ($this->session->login === TRUE && $this->session->user != ''){
				$this->load->view($template."/status.php", $data);
			}
			else{
				session_destroy();
				redirect($login);	
			}	
		}
		else if ($method == "logout"){
			if(isset($_SESSION['user'])){
				if ($this->session->dst == 'logout'){
					$this->load->view($template."/logout.php", $data);
					$this->session->unset_userdata('dst');
				}
				else if($this->session->login === FALSE){
					redirect($login);
				}
				else{
					$this->M_demo->logout();
				}
			}
			else{
				redirect($login);
			}
		}
		else{
			echo "index";
		}
	}
}
