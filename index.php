<?php
	include_once "core/init.php";
	$shorten = new Shorten();
	$conn = $shorten->conn;
	$query = $shorten->queryAll("SELECT * FROM url ORDER BY addtime DESC",array(),$conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Url Shortener</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h2 class="text-center title">Url Shortener</h2>
				<div class="shortener">
					<form method="POST" action="shorten.php" class="form-inline">
						  <div class="form-group">
						  		<span class="glyphicon glyphicon-hand-right"></span>
						  		<input type="text" name ="url" id="url" class="form-control" placeholder="Past Your Long URL Here">
						  		<button type="submit" class="btn btn-default">Shorten</button>
						  </div>
					</form>
				</div>
				<div class="shorten_url">
					<h2 class="text-center">Shorten URL</h2>
					<table class="table table-bordered table-striped">
						<thead>
							<th></th>
							<th>URL</th>
							<th>Shoren URL</th>
						</thead>
						<tbody>
							<?php foreach($query as $url) : ?>
							<tr>
								<td><span class="glyphicon glyphicon-remove"></span></td>
								<td><?php echo $url['url']; ?></td>
								<td><a target="_blank" href="http://localhost/shortener/<?php echo $url['code']; ?>">http://localhost/shortener/<?php echo $url['code']; ?></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>