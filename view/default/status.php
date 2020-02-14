<html>
<head>
<?php if($refresh != ''){?>
<meta http-equiv="refresh" content="$(refresh-timeout-secs)">
<?php } ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="-1">
<title>mikrotik hotspot > status</title>
<style type="text/css">
<!--
textarea,input,select {
	background-color: #FDFBFB;
	border: 1px #BBBBBB solid;
	padding: 2px;
	margin: 1px;
	font-size: 14px;
	color: #808080;
}

.tabula{
 
border-width: 1px; 
border-collapse: collapse; 
border-color: #c1c1c1; 
background-color: transparent;
font-family: verdana;
font-size: 11px;
}

body{ color: #737373; font-size: 12px; font-family: verdana; }

a, a:link, a:visited, a:active { color: #AAAAAA; text-decoration: none; font-size: 12px; }
a:hover { border-bottom: 1px dotted #c1c1c1; color: #AAAAAA; }
img {border: none;}
td { font-size: 12px; padding: 4px;}

-->
</style>
<script language="JavaScript">
<!--
<?php if($unk_no == 'yes'){?>
    var popup = '';
    function focusAdvert() {
	if (window.focus) popup.focus();
    }
    function openAdvert() {
	popup = open('', 'hotspot_advert', '');
	setTimeout("focusAdvert()", 1000);
    }
<?php } ?>
    function openLogout() {
	if (window.name != 'hotspot_status') return true;
        open('<?=$link_logout?>', 'hotspot_logout', 'toolbar=0,location=0,directories=0,status=0,menubars=0,resizable=1,width=280,height=250');
	window.close();
	return false;
    }
//-->
</script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0"
<?php if($unk_no == 'yes'){?>
	onLoad="openAdvert()"
<?php } ?>
>
<table width="100%" height="100%">

<tr>
<td align="center" valign="middle">
<form action="<?=$link_logout?>" name="logout" onSubmit="return openLogout()">
<table border="1" class="tabula">
<?php if($_SESSION['user'] == 'trial'){?>
	<br><div style="text-align: center;">Welcome trial user!</div><br>
<?php }elseif($_SESSION['user'] != 'mac'){?>
	<br><div style="text-align: center;">Welcome <?=$_SESSION["user"]?>!</div><br>
<?php } ?>
	<tr><td align="right">IP address:</td><td><?=$ip?></td></tr>
	<tr><td align="right">bytes up/down:</td><td><?=$byte_up?> / <?=$byte_down?></td></tr>
<?php if($time_left != ''){?>
	<tr><td align="right">connected / left:</td><td><?=$uptime?> / <?=$time_left?></td></tr>
<?php }else{ ?>
	<tr><td align="right">connected:</td><td><?=$uptime?></td></tr>
<?php } ?>
<?php if($unk_no == 'yes'){?>
	<tr><td align="right">status:</td><td><div style="color: #FF8080">
<a href="" target="hotspot_advert">advertisement</a> required</div></td>
<?php }elseif($refresh != ''){?>
	<tr><td align="right">status refresh:</td><td><?=$refresh?></td>
<?php } ?>

</table>
<?php if($_SESSION['user'] != 'mac'){?>
<br>
<!-- user manager link. if user manager resides on other router, replace $(hostname) by its address
<button onclick="document.location='http://$(hostname)/user?subs='; return false;">status</button>
<!-- end of user manager link -->
<input type="submit" value="log off">
<?php } ?>
</form>

</td>
</table>
</body>
</html>
