<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?=$config['server-name']?> - Login</title>
		<link rel="icon" href="<?=$assets?>icon.ico" />
		<link rel="stylesheet" href="<?=$assets?>bootstrap.min.css?version=0.0.1" />
		<link rel="stylesheet" href="<?=$assets?>genta.css?version=0.0.1" />
	</head>
	<body>
		<form name="sendin" action="<?=$link_login?>" method="post">
			<input type="hidden" name="username" />
			<input type="hidden" name="password" />
		</form>
		<script type="text/javascript" src="<?=$assets?>md5.js"></script>
		<script type="text/javascript">
			function doLogin(){
				let xyz = document.login;
				let zyx = document.sendin;
				if (xyz.tipe.value == "mb"){
					zyx.username.value = xyz.username.value;
					zyx.password.value = hexMD5(xyz.password.value);
					zyx.submit();
					return false;
				}
				else{
					zyx.username.value = xyz.username.value;
					zyx.password.value = hexMD5(xyz.username.value);
					zyx.submit();
					return false;
				}
			}
		</script>
		<div class="container-fluid container-bg">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title host"><a href=<?=$link_login?>><strong><?=$config['server-name']?></strong></a></h1>
					<small>PREMIUM TEMPLATE MIKROTIK LOGIN HOTSPOT</small>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Login</h3>
								</div>
								<div class="panel-body">
									<div class="btn-group btn-group-justified" role="group" aria-label="...">
										<div class="btn-group" role="group">
											<button onclick="l_mb()" id="mb_btn" type="button" class="btn btn-sm btn-success btn-text">Member</button>
										</div>
										<div class="btn-group" role="group">
											<button onclick="l_vc()" id="vc_btn" type="button" class="btn btn-sm btn-warning btn-text">Voucher</button>
										</div>
										<div class="btn-group" role="group">
											<button onclick="window.open('https://laksa19.github.io/myqr','_blank')" type="button" class="btn btn-sm btn-danger btn-text">QR Code</button>
										</div>
									</div>
									<br />
									<form name="login" action=<?=$link_login?> method="post" onSubmit="return doLogin()">
										<input type="hidden" name="tipe" value="mb" />
										<div class="form-group">
											<input class="form-control" type="text" name="username" placeholder="type username" value="admin" autofocus />
										</div>
										<div class="form-group" id="pw">
											<div class="input-group">
												<input class="form-control" type="password" name="password" placeholder="type password" value="admin" />
												<div class="input-group-addon"><input type="checkbox" id="s_pw" onclick="show_pw()"></div>
											</div>
										</div>
										<button type="submit" class="btn btn-block btn-info">Kirim</button>
									</form>
									<?php
										if($config['trial'] == 'yes'){
											echo '<p class="text-center">Coba gratis, <a href="'.$link_login.'&username=trial&password=trial">klik disini</a></p>';
										}
										if($this->session->flashdata() != NULL){
											echo '<br /><div class="alert alert-danger text-center">'.$this->session->flashdata('error').'</div>';
										}
									?>					
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Harga Voucher</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive" id="tablegsvc"></div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="panel-group">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a role="button" onclick="col_1()">Informasi</a>
										</h4>
									</div>
									<div id="col-1" class="panel-collapse collapse in">
										<div class="panel-body">
											<p align="justify" class="text-break">
												Tolong diperhatikan saat mengetik, besar kecil huruf berpengaruh!
												<br />
												<br />
												Pastikan sama dengan voucher.
											</p>
										</div>
									</div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a role="button" onclick="col_2()" class="collapsed">Mitra</a>
										</h4>
									</div>
									<div id="col-2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="table-responsive" id="tablegsmitra"></div>
										</div>
									</div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a role="button" onclick="col_3()" class="collapsed">Hubungi Kami</a>
										</h4>
									</div>
									<div id="col-3" class="panel-collapse collapse">
										<div class="panel-body">
											<p align="justify" class="text-break">
												Telp : +62-852-1999-5161 <br />
												Email : genta.sumantri@gmail.com
												<br /><br />
												Atau bisa menggunakan fitur Live Chat :)
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 bg-info footer">
							<span class="col-xs-6">
								IP: <text class="footer-text"><?=$this->input->ip_address()?></text><br />
								Mac: <text class="footer-text">01:02:03:04:05:06</text>
							</span>
							<span class="col-xs-6">
								Bahasa:<br />
								<a href='<?=$link_login?>?lang=en'>English</a> / <abbr title="Kamu ada di halaman Bahasa Indonesia" class="initialism">Indonesia</abbr>
							</span>
							<span class="col-xs-12 author">Template by <a href="mailto:genta.sumantri@gmail.com" target="_blank">Genta Sumantri</a> | Powered by <a href="https://getbootstrap.com/" rel="noreferrer" target="_blank">Bootstrap</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="<?=$assets?>genta.js"></script>
	<script type="text/javascript">
		l_mb();
		loadfil('<?=$data?>table_id.csv','tbvc');
		loadfil('<?=$data?>mitra.csv','tbmtr');
	</script>
</html>