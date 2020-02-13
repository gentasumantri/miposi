<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->load->helper('file');
	}
	
	public function files($file){
		$path		= './view/bawaan/';
		$oldFile	= file_get_contents($path.$file.'.html');
		$patterns	= array();
		$patterns[0] = '/="(\/assets\/)/';
		$patterns[1] = '/[$][(](server-name)[)]/';
		$patterns[2] = '/([$][(](link-login-only)[)])(.{0,46})([)]["])/';
		$patterns[3] = '/["][$][(](link-login-only)[)]["]/';
		$patterns[4] = '/[$][(](link-login-only)[)](.{0,28})[=]/';
		$patterns[5] = "/[(]['][$][(](chap-id)[)]['](\s[+]\s)/";
		$patterns[6] = "/(\s[+].['])[$][(](chap-challenge)[)][']/";
		$patterns[7] = '/[$][(](elif plain-passwd == "yes")[)]/';
		$patterns[8] = '/[$][(](if chap-id)[)]/';
		$patterns[9] = "/[$][(](if trial == 'yes')[)]/";
		$patterns[10] = '/[$][(](if error)[)]/';
		$patterns[11] = '/[$][(](error)[)]/';
		$patterns[12] = '/[$][(](endif)[)]/';
		$patterns[13] = "/(loadfil[(]'\/data\/)/";
		$patterns[14] = '/[$][(](if plain-passwd == '."'yes'".')[)]/';
		$patterns[15] = '/[$][(](ip)[)]/';
		$patterns[16] = '/[$][(](mac)[)]/';
		$patterns[17] = '/[$][(](if refresh-timeout)[)]/';
		$patterns[18] = '/[$][(](refresh-timeout-secs)[)]/';
		$patterns[19] = "/[$][(](if advert-pending == 'yes')[)]/";
		$patterns[20] = "/[$][(](if session-time-left)[)]/";
		$patterns[21] = "/[$][(](if login-by == 'trial')[)]/";
		$patterns[22] = "/[$][(](elif login-by != 'mac')[)]/";
		$patterns[23] = "/[$][(](if blocked == 'yes')[)]/";
		$patterns[24] = '/[$][(](elif refresh-timeout)[)]/';
		$patterns[25] = "/[$][(](if login-by-mac != 'yes')[)]/";
		$patterns[26] = '/["][$][(](link-logout)[)]["]/';
		$patterns[27] = "/[$][(](username)[)]/";
		$patterns[28] = "/[$][(](if login-by != 'mac')[)]/";
		$patterns[29] = "/[$][(](else)[)]/";
		$patterns[30] = '/["][$][(](link-login)[)]["]/';
		
		$replacements	= array();
		$replacements[0] = '="<?=$assets?>';
		$replacements[1] = '<?=$server_name?>';
		$replacements[2] = '<?=$link_login?>?username=trial&password=trial"';
		$replacements[3] = '"<?=$link_login?>"';
		$replacements[4] = '<?=$link_login?>?lang=';
		$replacements[5] = '(';
		$replacements[6] = '';
		$replacements[7] = '<?php }elseif($plain_passwd == TRUE){ ?>';
		$replacements[8] = '<?php if($chap_id == TRUE){ ?>';
		$replacements[9] = '<?php if($trial == TRUE){?>';
		$replacements[10] = '<?php if($this->session->flashdata() != NULL){ ?>';
		$replacements[11] = '<?=$this->session->flashdata("error")?>';
		$replacements[12] = '<?php } ?>';
		$replacements[13] = 'loadfil('."'".'<?=$data?>';
		$replacements[14] = '<?php if($plain_passwd == TRUE){ ?>';
		$replacements[15] = '<?=$this->input->ip_address()?>';
		$replacements[16] = '01:02:03:04:05:06';
		$replacements[17] = '<?php if($refresh == TRUE){?>';
		$replacements[18] = '<?=$refresh_sec?>';
		$replacements[19] = '<?php if($advert == TRUE){?>';
		$replacements[20] = '<?php if($session_time_left == TRUE){?>';
		$replacements[21] = '<?php if($_SESSION["user"] == "trial"){?>';
		$replacements[22] = '<?php }elseif($_SESSION["user"] != "mac"){?>';
		$replacements[23] = '<?php if($blocked == TRUE){?>';
		$replacements[24] = '<?php }elseif($refresh == TRUE){?>';
		$replacements[25] = '<?php if($login_by_mac != TRUE ){?>';
		$replacements[26] = '"<?=$link_logout?>"';
		$replacements[27] = '<?=$_SESSION["user"]?>';
		$replacements[28] = '<?php if($_SESSION["user"] != '."'mac'".'){?>';
		$replacements[29] = '<?php }else{?>';
		$replacements[30] = '<?=$link_login?>';
		
		$newFile = preg_replace($patterns, $replacements, $oldFile);
		
		write_file ($path.$file.'.php', $newFile);
		
	}
	
}
