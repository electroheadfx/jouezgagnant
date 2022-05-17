<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>jouezgagnant</title>
	<meta name="generator" content="BBEdit 8.7" />
	<style type="text/css" title="text/css" media="all">@import url(/media/css/jg.css);</style>
	<style type="text/css" title="text/css" media="all">@import url(/media/css/race.css);</style>
</head>
<body id="results">

<?php
$page = "results";
include('./includes/head.php');
?>

<div id="content">
	<h2>Predictions</h2>
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
			<span class="label">PMU meet n&deg;:</span>
			<span id="racespot" class="value">1</span>
		</li>
	</ul>

	<ul class="races">
		<li class="label">Race N&deg;:</li>
		<li class="raceon">5</li>
		<li>7</li>
		<li>8</li>
		<li>11</li>
	</ul>
	<div id="racepane">
		<div class="racenotes">
			<!--
			<span class="racelabel">Race N&deg;</span>
			<span class="racevalue">
				<select type="select">
					<option value="5">5</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="11">11</option>
				</select>
			</span>
			-->
			<span class="racefiller">&nbsp;</span>
			
			<span class="label">Profit Seeked</span><span class="value"><input id="profit" type="text" /></span>
			<span class="label">Previous Loss</span><span class="value"><input id="loss" type="text" /></span>
		</div>
		<div class="racelabels">
			<div class="pad">&nbsp;</div>
			<span class="jgdata">jouezgagnant</span>
			<span class="clientdata">your picks</span>
			<span class="horsedata">horse's odds</span>
			<span class="pmudata">PMU bet</span>
			<span class="totaldata">total</span>
			<div class="pad">&nbsp;</div>
		</div>
		<div class="raceinfo">
			<div class="pad">&nbsp;</div>
			<div class="jgdata">
				<span class="rowdata">10</span>
				<span class="rowdata">8</span>
				<span class="rowdata">4</span>
			</div>
			<div class="clientdata">
				<span class="rowdata field"><input id="c1" type="text" /></span>
				<span class="rowdata field"><input id="c2" type="text" /></span>
				<span class="rowdata field"><input id="c3" type="text" /></span>
			</div>
			<div class="horsedata">
				<span class="rowdata field"><input id="h1" type="text" /></span>
				<span class="rowdata field"><input id="h2" type="text" /></span>
				<span class="rowdata field"><input id="h3" type="text" /></span>
			</div>
			<div class="pmudata">
				<span class="rowdata" id="pmu1">--</span>
				<span class="rowdata" id="pmu2">--</span>
				<span class="rowdata" id="pmu3">--</span>
			</div>
			<div class="totaldata">
				<span class="rowdata">&euro;</span>
				<span class="calculate rowdata2">
					<a href="" class="calculate">calculate bet</a>
				</span>
			</div>
			<div class="pad">&nbsp;</div>
		</div>
	</div>
</div>

<?php include('./includes/foot.php'); ?>

</body>
</html>
