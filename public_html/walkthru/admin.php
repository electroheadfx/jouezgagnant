<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>jouezgagnant</title>
	<meta name="generator" content="BBEdit 8.7" />
	<style type="text/css" title="text/css" media="all">@import url(/media/css/jg.css);</style>
	<style type="text/css" title="text/css" media="all">@import url(/media/css/admin.css);</style>
</head>
<body id="admin">

<?php
$page = "results";
include('./includes/head.php');
?>

<div id="content">

	<div id="racepane">
		<div class="racenotes">
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
