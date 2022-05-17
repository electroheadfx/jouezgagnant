<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>jouezgagnant</title>
	<meta name="generator" content="BBEdit 8.7" />
	<style type="text/css" title="text/css" media="all">@import url(/media/css/jg.css);</style>
</head>
<body>

<?php
$page = "subscriptions";
include('./includes/head.php');
?>

<div id="content">
	<h2>Subscriptions</h2>
	<ul class="table">
		<li>
			<span class="label">Instant Prediction</span>
			<span class="notes">Access to today's predictions immmediately.</span>
			<span class="rate">&euro;3,5</span>
			<span class="purchase"><a href="order.php" class="buybutton">purchase</a></span>
		</li>
		<li class="even">
			<span class="label">5 Credits</span>
			<span class="notes">5 credits to use in a span of 2 months.</span>
			<span class="rate">&euro;12,5</span>
			<span class="purchase"><a href="order.php" class="buybutton">purchase</a></span>
		</li>
		<li>
			<span class="label">10 Credits</span>
			<span class="notes">10 credits to use in a span of 4 months.</span>
			<span class="rate">&euro;19,5</span>
			<span class="purchase"><a href="order.php" class="buybutton">purchase</a></span>
		</li>
		<li class="even">
			<span class="label">30 Credits</span>
			<span class="notes">30 credits to use in a span of 6 months.</span>
			<span class="rate">&euro;49,5</span>
			<span class="purchase"><a href="order.php" class="buybutton">purchase</a></span>
		</li>
	</ul>
</div>

<?php include('./includes/foot.php'); ?>

</body>
</html>
