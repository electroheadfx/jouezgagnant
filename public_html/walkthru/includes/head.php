<?php

switch ($page) {
	case "account":
		$st_account = ' class="menuon"';
		break;
	case "home":
		$st_home = ' class="menuon"';
		break;
	case "subscriptions":
		$st_subscriptions = ' class="menuon"';
		break;
	case "results":
		$st_results = ' class="menuon"';
		break;
}

?>
<div id="head">
	<img id="logo" src="/media/i/jouezgagnant.png" alt="jouezgagnant.fr" border="0" height="108">
	<h1 class="off">jouez gagnant.fr</h1>
	<div id="authenticate">
		<ul class="entry">
			<li><input id="username" type="text"></li>
			<li><input id="password" type="text"></li>
			<li><a id="login" href="" class="mainbutton">login</a></li>
		</ul>
	</div>
	<div id="navigation">
		<ul class="menu">
			<li<?php echo $st_home ?>><a class="menuitem" href="/walkthru/home.php">Home</a></li>
			<li<?php echo $st_results ?>><a class="menuitem" href="/walkthru/results.php">Predictions</a></li>
			<li<?php echo $st_subscriptions ?>><a class="menuitem" href="/walkthru/subscriptions.php">Subscriptions</a></li>
			<li<?php echo $st_account ?>><a class="menuitem" href="/walkthru/account.php">Account</a></li>
			<li class="admin"><a class="menuitem" href="/walkthru/admin.php">Administration</a></li>
		</ul>
	</div>
</div>
