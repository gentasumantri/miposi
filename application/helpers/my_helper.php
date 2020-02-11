<?php

function dd($data){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	die;
};

function check_lang($getLang){
	if(!isset($_SESSION['lang']) || $getLang == 'en'){
		$_SESSION['lang'] = '';
	}
	else if($getLang != NULL && $getLang != $_SESSION['lang']){
		$_SESSION['lang'] = '/'.$getLang;
	}
}

function check_login(){
	$ci =& get_instance();
	if (isset($_SESSION['login']) && $_SESSION['login'] === TRUE){
		return TRUE;
	}
	else if (isset($_SESSION['cookies']) && $_SESSION['cookies'] === TRUE){
		$_SESSION['login'] = TRUE;
		return TRUE;
	}
	return FALSE;
}