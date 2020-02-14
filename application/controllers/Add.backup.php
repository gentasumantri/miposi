<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->helper('file');
		$this->load->model('M_demo');
	}
	
	public function files($folder,$subfolder = NULL){
		/* 
			!!! ORDER OF PATTERN IS IMPORTANT !!!
		*/
		
		$pattern = array(
			'/="(\/assets\/)/'	=> '="<?=$assets?>',
			
			'/[$][(](server-name)[)]/'	=> '<?=$server_name?>',
			
			'("[$][(]link-login-only[)])([?]dst=[$][(]link-orig-esc[)]&amp;username=T-[$][(]mac-esc[)]")'	=> '"<?=$link_login?>?username=trial&password=trial"',
			
			'/["][$][(](link-login-only)[)]["]/'	=> '"<?=$link_login?>"',
			
			'/[$][(](link-login-only)[)](.{0,28})[=]/'	=> '<?=$link_login?>?lang=',
			
			"/[(]['][$][(](chap-id)[)]['](\s[+]\s)/"	=> '(', 
			
			"/(\s[+].['])[$][(](chap-challenge)[)][']/"	=> '', 
			
			"/[$][(](elif plain-passwd == 'yes')[)]/" => '<?php }elseif($http_pap == TRUE){ ?>', 
			
			'/[$][(](if chap-id)[)]/'	=> '<?php if($http_chap == TRUE){ ?>', 
			
			"/[$][(](if trial == 'yes')[)]/"	=> '<?php if($trial == TRUE){?>', 
			
			'/[$][(](if error)[)]/'	=> '<?php if($this->session->flashdata('."'error'".')){ ?>', 
			
			'/[$][(](error)[)]/'	=> '<?=$this->session->flashdata('."'error'".')?>', 
			
			'/[$][(](endif)[)]/'	=> '<?php } ?>',
			
			"/(loadfil[(]'\/data\/)/"	=> 'loadfil('."'".'<?=$data?>', 
			
			'/[$][(](if plain-passwd == '."'yes'".')[)]/'	=> '<?php if($http_pap == TRUE){ ?>',  
			
			'/[$][(](ip)[)]/'	=> '<?=$this->input->ip_address()?>', 
			
			'/[$][(](mac)[)]/'	=> '01:02:03:04:05:06', 
			
			'/[$][(](if refresh-timeout)[)]/'	=> '<?php if($refresh != ""){?>', 
			
			'/[$][(](refresh-timeout-secs)[)]/'	=> '<?=$refresh?>', 
			
			"/[$][(](if advert-pending == 'yes')[)]/"	=> '<?php if($advert == TRUE){?>', 
			
			"/[$][(](if session-time-left)[)]/"	=> '<?php if($sess_time_left != ""){?>', 
			
			"/[$][(](if login-by == 'trial')[)]/"	=> '<?php if($_SESSION["user"] == "trial"){?>', 
			
			"/[$][(](elif login-by != 'mac')[)]/"	=> '<?php }elseif($_SESSION["user"] != "trial"){?>', 
			
			"/[$][(](if blocked == 'yes')[)]/"	=> '<?php if($blocked == TRUE){?>',  
			
			'/[$][(](elif refresh-timeout)[)]/'	=> '<?php }elseif($refresh != TRUE){?>', 
			
			"/[$][(](if login-by-mac != 'yes')[)]/"	=> '<?php if($login_by_mac != TRUE ){?>', 
			
			'/["][$][(](link-logout)[)]["]/'	=> '"<?=$link_logout?>"', 
			
			'/value="[$][(](username)[)]"/'	=> '', 
			
			"/[$][(](username)[)]/"	=> '<?=$_SESSION["user"]?>', 
			
			"/[$][(](else)[)]/"	=> '<?php }else{?>', 
			
			'/["][$][(](link-login)[)]["]/'	=> '"<?=$link_login?>',
			
			'/["][$][(](link-status)[)]/'	=> '"<?=$link_status?>'
			
		);
		
		$path		= './view/'.$folder.'/';
		$this->M_demo->addFile($path, $pattern);
		
		if ($subfolder != NULL){
			$path	= './view/'.$folder.'/'.$subfolder.'/';
			$this->M_demo->addFile($path,$pattern);
		}
	}
	
}
