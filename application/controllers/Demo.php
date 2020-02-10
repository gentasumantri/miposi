<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->library('session');
	}
	
	public function natural_blue ($method = NULL){
		$template					= 'natural_blue';
		$data['assets'] 			= base_url('view/'.$template.'/assets/');
		$data['data']				= base_url('view/'.$template.'/data/');
		$data['link_login_theme']	= site_url('demo/'.$template.'/login');
		$data['link_logout_theme']	= site_url('demo/'.$template.'/logout');
		$data['link_login']			= site_url('demo/login');
		$data['link_logout']		= site_url('demo/logout');
		$data['config']				= array(
			'server-name'	=> 'igproject.net',
			'trial'			=> 'yes',
		);
		
		$this->session->theme = 'natural_blue';
		
		if ($method == "login"){
			if ($this->session->login === TRUE){
				redirect('demo/natural_blue/status');
			}
			$this->load->view($template."/login.php", $data);
		}
		else if ($method == "status"){
			if ($this->session->login === FALSE){
				redirect('demo/natural_blue/login');
			}
			$this->load->view($template."/status.php", $data);
		}
		else if ($method == "logout"){
			if($this->session->dst == 'logout') {
				$this->load->view($template."/logout.php", $data);
				$this->session->unset_userdata('dst');
			}
			else{
				redirect('demo/natural_blue/login');
			}
		}
		else{
			echo "index";
		}
	}
	
	public function login(){
		if($this->input->post_get('username')){
			$uname = $this->input->post_get('username');
			$upass = $this->input->post_get('password');
			if ($uname == 'admin' && $upass == md5('admin')){
				$sess = array(
					'user'	=> 'admin',
					'login'	=> TRUE
				);
				$this->session->set_userdata($sess);
				$link = 'demo/'.$this->session->userdata('theme').'/status';
				redirect($link);
			}
			else if ($uname == 'trial' && $upass == 'trial'){
				$sess = array(
					'user'	=> 'trial',
					'login'	=> TRUE
				);
				$this->session->set_userdata($sess);
				$link = 'demo/'.$this->session->userdata('theme').'/status';
				redirect($link);
			}
			else{
				$this->session->set_flashdata('error','wrong username or password');
				$link = 'demo/'.$this->session->userdata('theme').'/login';
				redirect($link);
			}
		}
		return false;
	}
	
	public function logout(){
		$this->session->login = FALSE;
		$this->session->dst = 'logout';
		$link = 'demo/'.$this->session->userdata('theme').'/logout';
		redirect($link);
	}
}
