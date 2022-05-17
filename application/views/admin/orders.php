<div id="content">
	<ul class="admin_nav">
		<li><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li class="selected"><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="orders">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<?php /*
					<a class="create" id="create_order">create</a>
					<script type="text/javascript">
						$('#create_order').click(function () {jg.admin.orders.create();});
					</script>
					*/ ?>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">order id</div>
			<div class="interior">
				<div class="border"></div>
				<div class="user title">user</div>
				<div class="date title">date</div>
				<div class="amount title">amount</div>
				<div class="status title">status</div>
				<div class="border"></div>
			</div>
		</div>
		<div class="toppad">
			<div class="label">&nbsp;</div>
			<div class="interior">
				<div class="border"></div>
				<div class="topcurves"></div>
				<div class="border"></div>
			</div>
		</div>
		
		<?php foreach ($orders as $row) : ?>
		<div id="row_<?php echo text::zero_pad($row->id, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label">
				<span><?php echo $row->id ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="user data"><?php echo "{$row->user->last_name}, {$row->user->first_name} ({$row->user->id})" ?></div>
				<div class="date data"><?php echo date::reformat_readable($row->process_date) ?></div>
				<div class="amount data">&euro;<?php echo $row->amount ?></div>
				<div class="status data"><img src="/media/i/<?php echo $row->status() ? 'star_on' : 'star_off' ?>.png" width="16" height="16" /></div>
				<div class="border"></div>
			</div>
		</div>
		<?php endforeach; ?>
		
		<div class="bottompad">
			<div class="label">&nbsp;</div>
			<div class="interior">
				<div class="border"></div>
				<div class="bottomcurves"></div>
				<div class="border"></div>
			</div>
		</div>
		<div class="bottombar">
			<div class="label">&nbsp;</div>
			<div class="interior">
				<?php echo $pagination->render() ?>
			</div>
		</div>

		<div id="edit_detail">
			<div class="edit_content">
				<div class="submit_row">
					<h4 id="edit_message">Create New Order</h4>
					<a class="cancel" id="cancel_order" href="<?php echo $back_link ?>">cancel</a>
				</div>
				<div class="edit_row">
					<label for="date">date</label>
					<div class="entry"><input id="date" type="text" size="20" maxlength="40"></div>
					<script type="text/javascript">
						<?php if ($lang !== 'en') { ?>
						$.datepicker.setDefaults($.datepicker.regional['<?php echo $lang ?>']);
						<?php } ?>
						$('#date').datepicker({
							dateFormat: "mm/dd/yy",
							showStatus: true,
							showOn: "both",
							buttonImage: "/media/i/calendar16.png",
							buttonImageOnly: true
						});
					</script>
				</div>
				<div class="edit_row">
					<label for="time">time</label>
					<div class="entry"><input id="time" type="text" size="20" maxlength="40"></div>
				</div>
				<div class="edit_row">
					<label for="spot">spot</label>
					<div class="entry"><input id="spot" type="text" size="40" maxlength="60"></div>
				</div>
				<div class="edit_row">
					<label for="pmu">pmu meet n&deg;</label>
					<div class="entry"><input id="pmu" type="text" size="5" maxlength="3"></div>
				</div>
				<div class="edit_row">
					<label for="pmu">race n&deg;</label>
					<div class="entry"><input id="race" type="text" size="5" maxlength="3"></div>
				</div>
				<div class="edit_row">
					<label for="pmu">1st pick</label>
					<div class="entry"><input id="first" type="text" size="8" maxlength="3"></div>
				</div>
				<div class="edit_row">
					<label for="pmu">2nd pick</label>
					<div class="entry"><input id="second" type="text" size="8" maxlength="3"></div>
				</div>
				<div class="edit_row">
					<label for="pmu">3rd pick</label>
					<div class="entry"><input id="third" type="text" size="8" maxlength="3"></div>
				</div>
				<?php /*
				<div class="submit_row">
					<a class="submit" id="submit_order">create</a>
				</div>
					*/ ?>
			</div>
			<script type="text/javascript">
				$('#submit_order').click(function () {jg.admin.orders.submit();});
			</script>
		</div>
	</div>
</div>
