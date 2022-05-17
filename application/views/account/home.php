<div id="content">
	<h2>
		<?php echo Kohana::lang('account.header') ?>
	</h2>

	<div id="account_pane">
		<div id="credit_pane">
			<div class="credit_window">
				<h4 class="window_title"><?php echo Kohana::lang('account.account_history') ?></h4>
				<div class="pane_head">
					<div class="pane_item primary">
						<span class="label"><?php echo Kohana::lang('account.credits_available') ?>: </span>
						<span class="value"><?php echo $user->credits_available() ?></span>
					</div>
					<div class="pane_item secondary">
						<span class="label"><?php echo Kohana::lang('account.credits_spent') ?>: </span>
						<span class="value"><?php echo $user->credits_spent() ?></span>
					</div>
				</div>
				<div class="pane_list credits_spent">
					<h3 class="head"><?php echo Kohana::lang('account.recent_usage') ?></h3>
					<div class="row">
						<div class="title credits"><?php echo Kohana::lang('account.credits') ?></div>
						<div class="title expires"><?php echo Kohana::lang('account.expiration_date') ?></div>
						<div class="title used"><?php echo Kohana::lang('account.date_used') ?></div>
					</div>
					<?php foreach ($used_credits as $i => $credit) { ?>
						<?php (($i % 2) === 0) ? $n = 'even' : $n = 'odd'; ?>
						<div class="row <?php echo $n ?>">
							<div class="data credits">1</div>
							<div class="data expires"><?php echo date::date_in_language($credit->expiry_date, '%d %B, %Y') ?></div>
							<div class="data used"><?php echo date::date_in_language($credit->date_used, '%d %B, %Y') ?></div>
						</div>
					<?php } ?>
				</div>
				<div class="pane_list credits_open">
					<h3 class="head"><?php echo Kohana::lang('account.available_credits') ?></h3>
					<div class="row">
						<div class="title credits"><?php echo Kohana::lang('account.credits') ?></div>
						<div class="title expires"><?php echo Kohana::lang('account.expiration_date') ?></div>
					</div>
					<?php foreach ($open_credits as $j => $credit) { ?>
						<?php (($j % 2) === 0) ? $n = 'even' : $n = 'odd'; ?>
						<div class="row <?php echo $n ?>">
							<div class="data credits">1</div>
							<div class="data expires"><?php echo date::date_in_language($credit->expiry_date, '%d %B, %Y') ?></div>
						</div>
					<?php } ?>
				</div>
				<div class="pane_list orders">
					<h3 class="head"><?php echo Kohana::lang('account.recent_orders') ?></h3>
					<div class="row">
						<div class="title date"><?php echo Kohana::lang('account.date') ?></div>
						<div class="title amount"><?php echo Kohana::lang('account.amount') ?></div>
						<div class="title status"><?php echo Kohana::lang('account.status') ?></div>
						<div class="title credits"><?php echo Kohana::lang('account.credits') ?></div>
					</div>
					<?php foreach ($orders as $k => $order) { ?>
						<?php (($k % 2) === 0) ? $n = 'even' : $n = 'odd'; ?>
						<div class="row <?php echo $n ?>">
							<div class="data date"><?php echo date::date_in_language($order->date, '%d %B, %Y') ?></div>
							<div class="data amount"><?php echo $order->amount ?> &euro;</div>
							<div class="data status"><?php echo $order->status ?></div>
							<div class="data credits"><?php echo $order->credits ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	
		<div id="info_pane">
			<div class="info_window">
				<h4 class="window_title"><?php echo Kohana::lang('account.your_info') ?></h4>
				<div class="labels">
					<div class="cell"><?php echo Kohana::lang('account.email') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.firstname') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.lastname') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.address1') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.address2') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.city') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.postal_code') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.birth_date') ?></div>
				</div>
				<div class="interior">
					<div class="data">
						<div class="cell"><?php echo $user->email ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->first_name ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->last_name ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->address ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->address2 ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->city ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo $user->postal_code ?></div>
					</div>
					<div class="data">
						<div class="cell"><?php echo date::date_in_language($user->birth_date, '%d %B, %Y') ?></div>
					</div>
				</div>
				<div class="bottom">
					<div class="label_push">&nbsp;</div>
					<div class="bottom_note"><a href="<?php echo url::site_lang('/account/edit') ?>" class="greenButton"><?php echo Kohana::lang('account.edit') ?></a></div>
				</div>
			</div>
		</div>

		<div class="actions">
			<a href="<?php echo url::site_lang('/subscriptions') ?>" class="redButton medium"><?php echo Kohana::lang('account.subscriptions') ?></a>
			<a href="<?php echo url::site_lang('/predictions') ?>" class="greenButton medium"><?php echo Kohana::lang('account.predictions') ?></a>
		</div>
	</div>
</div>
