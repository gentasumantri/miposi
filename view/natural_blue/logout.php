<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?=$config['server-name']?> - Logout</title>
		<link rel="icon" href="<?=$assets?>icon.ico" />
		<link rel="stylesheet" href="<?=$assets?>bootstrap.min.css?version=0.0.1" />
		<link rel="stylesheet" href="<?=$assets?>genta.css?version=0.0.1" />
	</head>
	<body>
		<div class="container container-sm">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title host"><a href=<?=$link_login?>><strong><?=$config['server-name']?></strong></a></h1>
					<small>Thanks for using our service :)</small>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="table-responsive">
								<table class="table table-bordered status-table">
									<tbody>
										
										<?php 
											if ($this->session->user == 'trial'){
												echo	'<tr>
															<td>Username</td>
															<td>Trial user</td>
														</tr>';
											}
											else{
												echo 	'<tr>
															<td>Username</td>
															<td>'.$this->session->user.'</td>
														</tr>';
											}
										?>
										<tr>
											<td>IP / Mac</td>
											<td><text class="text-info">127.0.0.1</text> / <text class="text-warning">01:02:03:04:05:06</text></td>
										</tr>
										<tr>
											<td>Up / Down</td>
											<td>1 MiB / 1 MiB</td>
										</tr>
										<tr>
											<td>Uptime</td>
											<td>2m</td>
										</tr>
										<tr>
											<td>Remain Quota</td>
											<td>100 MiB</td>
										</tr>
										<tr>
											<td>Time Left</td>
											<td>50m</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12 m-bot">
								<a href="<?=$link_login_theme?>" class="btn btn-block btn-primary" >BACK TO LOGIN PAGE</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 bg-info footer">
							<span class="col-xs-12 author">Template by <a href="mailto:genta.sumantri@gmail.com" target="_blank">Genta Sumantri</a> | Powered by <a href="https://getbootstrap.com/" rel="noreferrer" target="_blank">Bootstrap</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>