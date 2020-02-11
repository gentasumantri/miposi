<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_demo extends CI_Model {
	
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
		if ($this->session->user != ''){
			if ($this->input->post('erase-cookie') == 'false'){
				$sess = array(
					'login'		=> FALSE,
					'dst'		=> 'logout',
					'cookies'	=> TRUE
				);
			}
			else{
				$sess = array(
					'login'		=> FALSE,
					'dst'		=> 'logout',
					'cookies'	=> FALSE,
				);
			}
			$this->session->set_userdata($sess);
		}
		$link = 'demo/'.$this->session->userdata('theme').'/logout';
		redirect($link);
	}
	
}