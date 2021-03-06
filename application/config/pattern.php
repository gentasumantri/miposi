<?php
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
?>