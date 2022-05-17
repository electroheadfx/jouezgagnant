<div id="content">
	<p><?php echo Kohana::lang('account.question') ?>
	<a href="<?php echo url::site_lang('/account/create') ?>"><?php echo Kohana::lang('account.inscript') ?></a></p>
	<p><?php echo Kohana::lang('account.else') ?></p>
	<div id="login_pane">
		<form method="post" action="" id="user_login_form">
			<div class="login_window">
				<div class="labels">
					<div class="cell title"><?php echo Kohana::lang('account.email') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.password') ?></div>
				</div>
				<div class="interior">
					<div class="data">
						<div class="cell"><input type="text" id="email" name="email" value="<?php echo @$POST->email ?>" /></div>
					</div>
					<div class="data">
						<div class="cell"><input type="password" id="password" name="password" value="<?php echo @$POST->password ?>" /></div>
					</div>
					<div class="data">
						<div class="cell"><input id="login_submit" type="submit" value="<?php echo Kohana::lang('account.login') ?>" /></div>
					</div>
				</div>
				<div class="bottom">
					<div class="label_push">&nbsp;</div>
				</div>
			</div>
		</form>
	</div>
</div>