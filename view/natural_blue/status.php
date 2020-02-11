<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="refresh" content="60" />
		<title><?=$config['server-name']?> - Status</title>
		<link rel="icon" href="<?=$assets?>icon.ico" />
		<link rel="stylesheet" href="<?=$assets?>bootstrap.min.css?version=0.0.1" />
		<link rel="stylesheet" href="<?=$assets?>genta.css?version=0.0.1" />
	</head>
	<body>
		<div class="container container-sm">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title host"><a href=<?=$link_login_theme?>><strong><?=$config['server-name']?></strong></a></h1>
					<?php
						echo '<small>Welcome '.$this->session->user.'</small>';
					?>					
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover status-table">
									<tbody>
										<tr>
											<td>IP / Mac</td>
											<td><text class="text-info">127.0.0.1</text> / <text class="text-warning">01:02:03:04:05:06</text></td>
										</tr>
										<tr>
											<td>Up / Down</td>
											<td>100 MiB / 100 MiB</td>
										</tr>
										<tr>
											<td>Uptime</td>
											<td>10s</td>
										</tr>
										<tr>
											<td>Quota</td>
											<td>100 MiB</td>
										</tr>
										<tr>
											<td>Time Left</td>
											<td>2m</td>
										</tr>
										<!--$(if blocked == 'yes')
										<tr>
											<td>Status</td>
											<td><a href="$(link-advert)" class="text-danger" target="hotspot_advert">Watch ads to continue using internet.</a></td>
										</tr>
										<script type="text/javascript">alert('Watch ads to continue using internet.')</script>
										-->
										<tr>
											<td>Refresh</td>
											<td>60s</td>
										</tr>
										<tr>
											<td>Login by</td>
											<td>HTTP</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12">
								<form action="<?=$link_logout_theme?>" name="logout" method="POST">
									<div class="btn-group btn-group-justified" role="group">
										<div class="btn-group" role="group">
											<button class="btn btn-success" type="button" onclick="window.location.reload()">Refresh</button>
										</div>
										<div class="btn-group" role="group">
											<button class="btn btn-danger" type="submit" value="log off">Logout</button>
										</div>
									</div>
									<div class="m-top m-bot">
										<label class="radio-inline">
											<input type="radio" name="erase-cookie" value="false" checked /> Remember me!
										</label>
										<label class="radio-inline">
											<input type="radio" name="erase-cookie" value="true" /> Don't remember me!
										</label>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 bg-info footer">
							<span class="col-xs-12">
								Language:<br />
								<abbr title="You're in English page" class="initialism">English</abbr> /  <a href="$(link-status)?target=id">Indonesia</a>
							</span>
							<span class="col-xs-12 author">Template by <a href="mailto:genta.sumantri@gmail.com" target="_blank">Genta Sumantri</a> | Powered by <a href="https://getbootstrap.com/" rel="noreferrer" target="_blank">Bootstrap</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
