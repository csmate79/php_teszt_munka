<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Proba</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container navbar">
		<div class="row col-12">
			<div class="col-lg-6 col-xl-6 col-sm-12 col-md-6 col-12">
				<form method='post' action=''>
					<div>
						<input class="form-control" type="text" name="feedurl" placeholder="Enter website feed URL. (Ex.: https://justinpot.com/feed)">
					</div>
					<div>
						<input class="btn btn-primary mt-2 mt-xl-2 mt-lg-2 mt-md-2 mt-sm-2" type="submit" 
						name="submit" value='Submit'>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12 text-right mt-xl-0 mt-lg-0 mt-md-0 mt-sm-2 mt-2">
				<form id='form1' action='process.php' method="post">
					<div class="row">
						<div class="col-lg-6 col-xl-6 col-sm-6 col-md-6 col-6">
							<input class="form-control" type="text" name="uname" placeholder="username">
						</div>
						<div class="col-lg-6 col-xl-6 col-sm-6 col-md-6 col-6">
							<input class="form-control" type="password" name="password" placeholder="password">
						</div>
					</div>
				</form>
				<div class="btn">
					<form action='registration_page.php' class="btn">
						<input class="btn btn-light" type="submit" name="sign_up" value="Sign up">
					</form>
					<input class="btn btn-primary" type="submit" name="logsubmit" value="Login" form="form1">
				</div>
			</div>
		</div>
	</div>

	<?php 
	$url = "";
	if (isset($_POST['submit'])) {
		if ($_POST['feedurl'] != '') {
			$url = $_POST['feedurl'];
		}
	}

	$feeds;
	$invalidurl = false;
	if (@simplexml_load_file($url)) {
		$feeds = simplexml_load_file($url);
	} else {
		$invalidurl = true;
		echo "<div class='container'><h2>Invalid RSS feed URL.</h2></div>";
	}

	$i = 0;
	if (!empty($feeds)) {
		$site = $feeds->channel->title;
		$sitelink = $feeds->channel->link;

		echo "<h1 class='container'>".$site."</h1>";

		foreach ($feeds->channel->item as $item) {
			$title = $item->title;
			$link = $item->link;
			$description = $item->description;
			$postDate = $item->pubDate;
			$pubDate = date('D, d M Y', strtotime($postDate));

			if($i >= 5) {
				break;
			}
			?>

			<div class="container post">
				<hr>
				<div class="post-head">
					<h2><a class="feed-title" href="<?= $link ?>"><?= $title ?></a></h2>
					<span style="font-style: italic; font-size: 11px;"><?= $pubDate ?></span>
				</div>
				<div class="post-content">
					<?= implode(" ", array_slice(explode(' ',$description), 0,50)) ?>
				</div>
			</div>

			<?php 
			$i++;
		}
	} else {
		if (!$invalidurl) {
			echo "<h2>No item found.</h2>";
		}
	}
	?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>