<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*

	MIPOSI - Mikrotik Portal Simulation
	Build with Codeigniter 3
	Author : Genta Sumantri
	Contact : genta.sumantri@gmail.com

*/

class Demo extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('M_demo');
		$this->load->helper(array('my','file'));
	}
	
	public function mikrotik ($template, $method = NULL){
		
		/* Check the language input first (if exist) */
		check_lang($this->input->get('target')); 
		
		/* Important */
		$data['assets'] 			= base_url('view/'.$template.'/assets/'); // where's your assets file ?
		$data['data']				= base_url('view/'.$template.'/data/'); // my custom variable, ignore it
		$data['template_link']		= base_url('view/'.$template.'/');
		$data['link_login']			= site_url('demo/mikrotik/'.$template.'/login');
		$data['link_status']		= site_url('demo/mikrotik/'.$template.'/status');
		$data['link_logout']		= site_url('demo/mikrotik/'.$template.'/logout');
		
		/* Global */
		$data['server_name']		= 'igproject.net';
		$data['mac']				= implode(':', str_split(substr(md5(mt_rand()),0,12), 2)); // Create random mac
		$data['ip']					= $this->input->ip_address(); // Show real user Ip Address
		$data['mac_trial']			= 'trial'; // DONT CHANGE THIS
		
		/* Login Method */
		$data['http_chap']			= TRUE; // Use HTTP-CHAP
		$data['http_pap']			= FALSE; // Use HTTP-PAP -- it is better to keep this FALSE
		$data['trial']				= TRUE; // Is trial available ?
		
		/* Status Page */
		$data['refresh']			= '60'; /* Time before status page reload (sec)*/
		$data['time_left']			= '60 s';
		$data['byte_up']			= '10 Mib';
		$data['byte_down']			= '1000 Mib';
		$data['uptime']				= '10s';
		$data['remain_quota']		= '100 Mib';
		
		/* Misc */
		$data['unk_no']				= FALSE; // DONT CHANGE THIS
		
		if ($method == "login"){ // Show login page
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
				$this->output->set_header('Pragma: no-cache');
				$this->load->view($template.$_SESSION['lang'].'/login.php', $data);
			}
		}
		else if ($method == "status"){ // Show status page
			if (check_login() === TRUE){
				$this->output->set_header('Pragma: no-cache');
				$this->load->view($template.$_SESSION['lang']."/status.php", $data);
			}
			else{
				redirect($data['link_login']);
			}
		}
		else if ($method == "logout"){ // Show logout page
			if($this->M_demo->logout() === TRUE){
				$this->output->set_header('Pragma: no-cache');
				$this->load->view($template.'/'.$_SESSION['lang'].'/logout.php', $data);
				$this->session->unset_userdata('dst');
			}
			else{
				redirect($data['link_login']);
			}
		}
		else{
			redirect($data['link_login']);
		}
	}
	
	public function add($folder,$subfolder = NULL){
		/*
			!!! ORDER OF PATTERN IS IMPORTANT !!!
			PLACE YOUR OWN REGEX ON TOP
			['pattern__']	=>	['replacement__']
		*/
		$pattern = array(
			/* Custom */
			/*'/="(\/assets\/)/'			=> '="<?=$assets?>', // myCustom Regex */
			"/(loadfil[(]'\/data\/)/"		=> 'loadfil('."'".'<?=$data?>', // myCustom Regex
			'/(value="[$][(]username[)]")/'	=> '', // empty login form username value
			'/(\'[$][(]chap-id[)]\'\s[+]\s)|(\s[+]\s\'[$][(]chap-challenge[)]\')/' => '', // we dont need chap-challenge
			'/(\ssrc=("\/|"))/'				=> ' src="<?=$template_link?>', // src path for Js
			'/(\shref=("\/|"))(?![$]|http|mailto)/'	=> ' href="<?=$template_link?>', // href path for Css or link
			
			
			/* Global */
			'/([$][(]server-name[)])/'		=>	'<?=$server_name?>',
			'/([$][(]ip[)])/'				=>	'<?=$ip?>',
			'/([$][(]mac[)])/'				=>	'<?=$mac?>',
			'/([$][(]mac-esc[)])/'			=>	'<?=$mac_trial?>', // trial username trial -> T-trial
			
			/* Links */
			'/([$][(]link-login[)])/'		=>	'<?=$link_login?>', // link login
			'/([$][(]link-login-only[)])/'	=>	'<?=$link_login?>',
			'/([$][(]link-status[)])/'		=>	'<?=$link_status?>', // link status
			'/([$][(]link-logout[)])/'		=>	'<?=$link_logout?>', // link logout
			'/([$][(]link-advert[)])/'		=>	'', // for ads, not implemented yet
			'/([$][(]link-orig[)])/'		=>	'', // we dont need it
			'/([$][(]link-orig-esc[)])/'	=>	'', // we dont need it

			/* Login Method */
			'/([$][(]if chap-id[)])/'		=> '<?php if($http_chap === TRUE){?>', // HTTP CHAP
			'/([$][(]if plain-passwd == \'yes\'[)])/' => '<?php if($http_pap === TRUE){?>', // HTTP PAP
			'/([$][(]elif plain-passwd == \'yes\'[)])/' => '<?php }elseif($http_pap === TRUE){?>',
			'/([$][(]if trial == \'yes\'[)])/'	=>	'<?php if($trial == TRUE){?>', // create trial link
			'/([$][(]if login-by == \'trial\'[)])/'	=>	'<?php if($_SESSION[\'user\'] == \'trial\'){?>', // login determined by session user value
			'/([$][(]elif login-by != \'mac\'[)])/'	=>	'<?php }elseif($_SESSION[\'user\'] != \'mac\'){?>', // login determined by session user value
			'/([$][(]if login-by-mac != \'yes\'[)])/'	=>	'<?php if($_SESSION[\'user\'] != \'mac\'){?>', // login determined by session user value
			
			/* Error */
			'/([$][(]if error[)])/'			=> '<?php if($this->session->flashdata(\'error\')){?>', // check error using session flashdata
			'/([$][(]error[)])/'			=> '<?=$this->session->flashdata(\'error\')?>', // shows error
			
			/* Status */
			'/([$][(]username[)])/'			=>	'<?=$_SESSION["user"]?>',
			'/([$][(]bytes-in-nice[)])/'	=>	'<?=$byte_up?>',
			'/([$][(]bytes-out-nice[)])/'	=>	'<?=$byte_down?>',
			'/([$][(]remain-bytes-total-nice[)])/'	=>	'<?=$remain_quota?>',
			'/([$][(]uptime[)])/'			=>	'<?=$uptime?>',
			'/([$][(]session-time-left[)])/'	=>	'<?=$time_left?>',
			'/([$][(]if session-time-left[)])/'	=>	'<?php if($time_left != \'\'){?>',
			'/([$][(]refresh-timeout[)])/'	=>	'<?=$refresh?>',
			'/([$][(]if refresh-timeout[)])/'	=>	'<?php if($refresh != \'\'){?>',
			'/([$][(]elif refresh-timeout[)])/'	=>	'<?php }elseif($refresh != \'\'){?>',
			
			/* MISC */
			'/([$][(]endif[)])/'			=>	'<?php } ?>',
			'/([$][(]else[)])/'				=>	'<?php }else{ ?>',
			'/([$][(]if blocked == \'yes\'[)])/'	=>	'<?php if($unk_no == \'yes\'){?>', // for ads, not implemented yet
			'/([$][(]if advert-pending == \'yes\'[)])/'	=>	'<?php if($unk_no == \'yes\'){?>' // for ads, not implemented yet
		);
		
		$path	= './view/'.$folder.'/';
		$this->M_demo->addFile($path, $pattern);
		
		if ($subfolder != NULL){ // add sub-folder too
			$path	= './view/'.$folder.'/'.$subfolder.'/';
			$this->M_demo->addFile($path,$pattern);
		}
	}


}
