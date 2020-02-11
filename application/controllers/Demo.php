<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('M_demo');
		$this->load->helper('my');
	}
	
	public function natural_blue ($method = NULL){
		check_lang($this->input->get('lang'));
		$template					= 'natural_blue';
		$data['assets'] 			= base_url('view/'.$template.'/assets/');
		$data['data']				= base_url('view/'.$template.'/data/');
		$data['link_login']			= site_url('demo/'.$template.'/login');
		$data['link_status']		= site_url('demo/'.$template.'/status');
		$data['link_logout']		= site_url('demo/'.$template.'/logout');
		$data['config']				= array(
			'server-name'	=> 'igproject.net',
			'trial'			=> 'yes',
		);
		$this->session->template = 'natural_blue';
		
		if ($method == "login"){
			if (check_login() === TRUE){
				redirect($data['link_status']);
			}
			else if ($this->input->post_get('username')){
				if($this->M_demo->login() === TRUE){
					redirect($data['link_status']);
				}
				else{
					redirect($data['link_login']);
				}
			}
			else{
				$this->load->view($template.$_SESSION['lang'].'/login.php', $data);	
			}
		}
		else if ($method == "status"){
			if (check_login() === TRUE){
				$this->load->view($template.$_SESSION['lang']."/status.php", $data);
			}
			else{
				redirect($data['link_login']);
			}
		}
		else if ($method == "logout"){
			if($this->M_demo->logout() === TRUE){
				$this->load->view($template.'/'.$_SESSION['lang'].'/logout.php', $data);
				$this->session->unset_userdata('dst');
			}
			else{
				redirect($data['link_login']);
			}
		}
		else{
			echo "waktwat";
		}
	}
}
