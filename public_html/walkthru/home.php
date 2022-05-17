<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>jouezgagnant</title>
	<meta name="generator" content="BBEdit 8.7" />
	<style type="text/css" title="text/css" media="all">@import url(/media/css/jg.css);</style>
	<style type="text/css" title="text/css" media="all">@import url(/media/css/home.css);</style>
</head>
<body>

<?php
$page = "home";
include('./includes/head.php');
?>

<!-- Bienvenue sur jouez gagnant -->

<div id="home">
	<h2 class="hilite">Faire fructifier votre capital c&rsquo;est possible!</h2>
	<h4 class="text">Gr&acirc;ce &agrave; nos connaissances et nos syst&egrave;mes de gestion informatique, et r&eacute;alisez des gains r&eacute;guliers &agrave; partir de chez vous.</h4>
	<h3 class="focus">Comment?</h3>
	<h3 class="text">Retrouvez nos formules d&rsquo;abonnement ici:</h3>
	<span class="subscribe"><a href="subscriptions.php">subscriptions</a></span>
	
	<div class="example">
		<h3 class="tablehead">Day Result</h3>
		<ul id="racedetails">
			<li>
				<span class="label">date:</span>
				<span id="racedate" class="value">Tuesday, June 24th 2008</span>
			</li>
			<li>
				<span class="label">spot:</span>
				<span id="racespot" class="value">Longchamps</span>
			</li>
			<li>
				<span class="label">Race n&deg;:</span>
				<span id="racespot" class="value">1</span>
			</li>
		</ul>

		<div class="examples">
			<div id="ex_race">
				<div class="racelabels">
					<div class="pad">&nbsp;</div>
					<span class="jgdata">Jouezgagnant</span>
					<span class="horsedata">Horse's Odds</span>
					<div class="pad">&nbsp;</div>
				</div>
				<div class="raceinfo">
					<div class="pad">&nbsp;</div>
					<div class="jgdata">
						<span class="lrowdata">10</span>
						<span class="lrowdata">8</span>
						<span class="lrowdata">4</span>
					</div>
					<div class="horsedata">
						<span class="lrowdata field"><input id="h1" type="text" /></span>
						<span class="lrowdata field"><input id="h2" type="text" /></span>
						<span class="lrowdata field"><input id="h3" type="text" /></span>
					</div>
					<div class="pad">&nbsp;</div>
				</div>
			</div>
		
			<div id="ex_gains">
				<div class="racelabels">
					<div class="pad">&nbsp;</div>
					<span class="jgdata">Seeked Gains</span>
					<span class="horsedata">Total</span>
					<div class="pad">&nbsp;</div>
				</div>
				<div class="raceinfo">
					<div class="pad">&nbsp;</div>
					<div class="jgdata">
						<span class="rrowdata">50</span>
						<span class="rrowdata">100</span>
					</div>
					<div class="horsedata">
						<span class="rrowdata field"><input id="h1" type="text" /></span>
						<span class="rrowdata field"><input id="h2" type="text" /></span>
					</div>
					<div class="pad">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	
	<h4 class="hilite"><a href="history.php">View the last 3 months results</a></h4>
	<h4 class="text bottom">Contr&ocirc;lez gratuitement nos r&eacute;sultats en consultant notre site.</p>
</div>

<?php include('./includes/foot.php'); ?>

</body>
</html>
