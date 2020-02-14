<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_demo extends CI_Model {
	
	public function login(){
		if($this->input->post_get('username')){
			$uname = $this->input->post_get('username');
			$upass = $this->input->post('password');
			if ($uname == 'admin' && $upass == md5('admin')){
				$sess = array(
					'user'	=> 'admin',
					'login'	=> TRUE
				);
				$this->session->set_userdata($sess);
				return TRUE;
			}
			else if ($uname == 'T-trial'){
				$sess = array(
					'user'	=> 'trial',
					'login'	=> TRUE
				);
				$this->session->set_userdata($sess);
				return TRUE;
			}
			else{
				$this->session->set_flashdata('error','wrong username or password');
				return FALSE;
			}
		}
		return FALSE;
	}
	
	public function logout(){
		if (isset($_SESSION['user']) && $_SESSION['user'] != ''){
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
			return TRUE;
		}
		return FALSE;
	}
	
	public function addFIle($path,$pattern){
		$files		= array(
			'login'		=> 'login.html',
			'status'	=> 'status.html',
			'logout'	=> 'logout.html'
		);
		
		foreach($files as $file => $file_html):
		
			$oldFile	= file_get_contents($path.$file_html);
			
			$newFile	= preg_replace(array_keys($pattern), array_values($pattern), $oldFile);
			
			write_file ($path.$file.'.php', $newFile);
		
		endforeach;
	}
	
}