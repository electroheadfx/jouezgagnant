<div id="content">
	<ul class="admin_nav">
		<li><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li class="selected"><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="accounts">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<a class="create" id="create_account" href="<?php echo url::site_lang('/admin/users/create') ?>">create</a>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">internal account id</div>
			<div class="interior">
				<div class="border"></div>
				<div class="email title">email</div>
				<div class="name title">name</div>
				<div class="active title">active</div>
				<div class="postal title">postal code</div>
				<div class="birth title">birth date</div>
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
		
		<?php foreach ($users as $i => $usr) : ?>
		<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label">
				<a class="edit" href="<?php echo url::site("/admin/users/edit/$usr->id") ?>">edit</a>
				<a class="delete" href="<?php echo url::site("/admin/users/delete/$usr->id") ?>">delete</a>
				<span><?php echo text::zero_pad($usr->id, 5) ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="email data"><?php echo $usr->email ?></div>
				<div class="name data"><?php echo $usr->last_name ?>, <?php echo $usr->first_name ?></div>
				<div class="active data"><img src="/media/i/<?php echo $usr->active ? 'star_on' : 'star_off' ?>.png" width="16" height="16" /></div>
				<div class="postal data"><?php echo $usr->postal_code ?></div>
				<div class="birth data"><?php echo date::reformat_std($usr->birth_date, '-') ?></div>
				<div class="border"></div>
			</div>
			<div class="additional">
				<div class="border"></div>
				<div class="add_data">
					<div class="single_race">
						<span class="single_label">address: </span>
						<span class="single_entry"><?php echo $usr->address; if ($usr->address2) echo ", $usr->address2"; echo ", $usr->city, $usr->postal_code" ?></span>
					</div>
				</div>
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
					<h4 id="edit_message">Create New Account</h4>
					<a class="cancel" id="cancel_account" href="<?php echo $back_link ?>">cancel</a>
				</div>
				<form class="admin_form" id="user_admin<?php echo $method ?>_form" method="post">
					<div class="edit_row">
						<label for="first_name">first name</label>
						<div class="entry"><input id="first_name" name="first_name" type="text" size="40" maxlength="40" value="<?php if (isset($edit->first_name)) html::print_attr($edit->first_name) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="last_name">last_name</label>
						<div class="entry"><input id="last_name" name="last_name" type="text" size="40" maxlength="40" value="<?php if (isset($edit->last_name)) html::print_attr($edit->last_name) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="email">email</label>
						<div class="entry"><input id="email" name="email" type="text" size="40" maxlength="50" value="<?php if (isset($edit->email)) echo $edit->email ?>"></div>
					</div>
					<div class="edit_row">
						<label for="password">password</label>
						<div class="entry"><input id="password" name="password" type="text" size="40" maxlength="50"></div>
					</div>
					<div class="edit_row">
						<label for="address">address</label>
						<div class="entry"><input id="address" name="address" type="text" size="40" maxlength="50" value="<?php if (isset($edit->address)) html::print_attr($edit->address) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="address2">address 2</label>
						<div class="entry"><input id="address2" name="address2" type="text" size="40" maxlength="50" value="<?php if (isset($edit->address2)) html::print_attr($edit->address2) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="city">city</label>
						<div class="entry"><input id="city" name="city" type="text" size="40" maxlength="50" value="<?php if (isset($edit->city)) html::print_attr($edit->city) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="postal_code">postal code</label>
						<div class="entry"><input id="postal_code" name="postal_code" type="text" size="10" maxlength="15" value="<?php if (isset($edit->postal_code)) html::print_attr($edit->postal_code) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="birth_date">birth date</label>
						<div class="entry"><input id="birth_date" name="birth_date" type="text" size="15" maxlength="15" value="<?php if (isset($edit->birth_date)) html::print_attr($edit->birth_date) ?>"></div>
						<script type="text/javascript">
							$('#birth_date').datepicker({
								dateFormat: "mm/dd/yy",
								showStatus: true,
								showOn: "both",
								buttonImage: "/media/i/calendar16.png",
								buttonImageOnly: true
							});
						</script>
					</div>
					<div class="edit_row">
						<label for="active">active</label>
						<div class="entry"><input id="active" name="active" type="checkbox" <?php if (!isset($edit) || $edit->active) echo 'checked' ?>></div>
					</div>
				</form>
				<div class="submit_row">
					<a class="submit" id="submit_account">create</a>
				</div>
			</div>
			<script type="text/javascript">
				$('#cancel_account').click(function () {jg.admin.users.cancel();});
				$('#submit_account').click(function () {jg.admin.users.submit();});
			</script>
		</div>
	</div>
</div>
