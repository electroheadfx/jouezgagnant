<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $lang ?>">
<head>
	<title><?php echo $page_title; ?></title>
	<?php foreach ($stylesheets as $stylesheet) : ?>
	<style type="text/css" title="text/css" media="all">@import url(/media/css/<?php echo $stylesheet; ?>.css);</style>
	<?php endforeach; ?>
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="/media/css/ie.css" />
	<![endif]-->
	<?php foreach ($scripts as $script) : ?>
	<script type="text/javascript" src="/media/js/<?php echo $script ?>.js"></script>
	<?php endforeach; ?>
	<?php if ($js || $js_vars) : ?>
	<script type="text/javascript">
		<?php if ($js) echo $js ?>
		<?php if ($js_vars) foreach ($js_vars as $js_var => $value) : ?>
			var <?php echo $js_var ?> = <?php echo json_encode($value) ?>;
		<?php endforeach; ?>
	</script>
	<?php endif; ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<meta http-equiv="Content-Language" content="<?php echo $lang ?>" /> 
	<meta name="keywords" content="pmu,turf,turfiste,pronostics,pronos,hippique,hippodrome,paris,r&eacute;sultats,chevaux,courses,jouer,jouezgagnant,jeux,gain,gagnez,gagnant,bourse,rente,profits,b&eacute;n&eacute;fices,widget" />
	<meta name="verify-v1" content="9ZniHOjlVSQyaJ0ZcjV1fbYVfuybn1VJYQUHfwGMjsc=" />
</head>
<body<?php if (!empty($page_id)) { echo " id=\"$page_id\""; } ?>>
	
<div id="head">
	<img id="logo" src="/media/i/jouezgagnant.png" alt="jouezgagnant.fr" border="0" height="108" />
	<h1 class="off">jouezgagnant.fr</h1>
	<div id="navigation">
		<ul class="menu">
			<li<?php echo @$st_home ?>><a class="menuitem" href="<?php echo url::site_lang('/') ?>"><?php echo Kohana::lang('base.home') ?></a></li>
			<?php if ($user) : ?>
				<li<?php echo @$st_predictions ?>><a class="menuitem" href="<?php echo url::site_lang('/predictions') ?>"><?php echo Kohana::lang('base.predictions') ?></a></li>
			<?php endif; ?>
			<li<?php echo @$st_subscriptions ?>><a class="menuitem" href="<?php echo url::site_lang('/subscriptions') ?>"><?php echo Kohana::lang('base.subscriptions') ?></a></li>
			<?php if ($user) { ?>
				<li<?php echo @$st_account ?>><a class="menuitem" href="<?php echo url::site_lang('/account') ?>"><?php echo Kohana::lang('base.account') ?></a></li>
			<?php } else { ?>
				<li<?php echo @$st_account ?>><a class="menuitem" href="<?php echo url::site_lang('/account/login') ?>"><?php echo Kohana::lang('base.login') ?></a></li>
			<?php }?>
			<?php if ($user && $user->is_admin()) : ?>
				<li class="admin<?php if (isset($st_admin)) echo ' menuon'; ?>"><a class="menuitem" href="<?php echo url::site_lang('/admin') ?>"><?php echo Kohana::lang('base.administration') ?></a></li>
			<?php endif; ?>
			<?php if ($user) : ?>
				<li class="logout"><a class="menuitem" href="<?php echo url::site_lang('/account/logout') ?>"><?php echo Kohana::lang('base.logout') ?></a></li>
			<?php endif; ?>
			<li class="contact"><a class="menuitem" href="mailto:guy@jouezgagnant.fr"><?php echo Kohana::lang('base.contact') ?></a></li>
		</ul>
	</div>
</div>

<?php if (is_object($page_content)) $page_content->render(TRUE); else echo $page_content; ?>

<?php if ($messages) { ?>
	<div id="error_pane">
		<div class="error_messages">
			<h3 class="error_head"><?php echo Kohana::lang('base.notifications') ?></h3>
			
			<ul class="<?php echo $success_msg ? 'success_list' : 'error_list' ?>">
				<?php foreach ((array) $messages as $message) { ?>
					<li><?php echo $message ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>
<?php } ?>
	
<div id="foot">
	<div class="footc">
		<ul>
			<li><?php echo Kohana::lang('base.copyright') ?></li>
			<li><?php echo Kohana::lang('base.developed') ?></li>
		</ul>
	</div>
</div>

<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-6518860-1");
	pageTracker._trackPageview();
</script>

<script type="text/javascript">
	$(function () {
		jg.init();
		<?php
		if ($js_queue) {
			foreach ($js_queue as $func) {
				echo "{$func}\n";
			}
		}
		?>
	});
</script>

</body>
</html>
