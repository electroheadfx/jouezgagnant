<div id="content">
	<h2><?php echo Kohana::lang('subscriptions.agreement') ?></h2>
	<div class="scrollText">
		<?php echo Kohana::lang('subscriptions.terms') ?>
	</div>

	<div class="confirmation">
		<p class="agreement">
			<span id="agree_border">
				<?php echo Kohana::lang('subscriptions.accept') ?>
				<input id="agree" type="checkbox">
			</span>
		</p>
		<a id="confirmation" href="<?php echo url::site_lang('/subscriptions/confirm') ?>" class="redButton wide right"><?php echo Kohana::lang('subscriptions.continue') ?></a>
		<script type="text/javascript">
			$('#confirmation').click(function () {return jg.subscriptions.agree();});
		</script>
	</div>
</div>
