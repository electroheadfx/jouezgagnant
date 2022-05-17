<div id="content">
	<ul class="admin_nav">
		<li class="selected"><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="race_days">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<a class="create" id="create_race_day" href="<?php echo url::site_lang('/admin/race_days/create') ?>">create</a>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">race day id</div>
			<div class="interior">
				<div class="border"></div>
				<div class="day title">date</div>
				<div class="pmu_open title">pmu open</div>
				<div class="pmu_close title">pmu close</div>
				<div class="open title">jg open</div>
				<div class="close title">jg close</div>
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
		
		<?php foreach ($race_days as $i => $rc) : ?>
		<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label">
				<a class="edit" href="/admin/race_days/edit/<?php echo $rc->id ?>">edit</a>
				<a class="delete" href="/admin/race_days/delete/<?php echo $rc->id ?>">delete</a>
				<span><?php echo $rc->id ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="day data"><?php echo date::reformat_to_timezone($rc->day_open, 'M j, Y', $tz) ?></div>
				<div class="pmu_open data"><?php echo date::reformat_to_timezone($rc->day_open, 'H:i', $tz) ?></div>
				<div class="pmu_close data"><?php echo date::reformat_to_timezone($rc->day_close, 'H:i', $tz) ?></div>
				<div class="open data"><?php echo date::reformat_to_timezone($rc->jg_open, 'H:i', $tz) ?></div>
				<div class="close data"><?php echo date::reformat_to_timezone($rc->jg_close, 'H:i', $tz) ?></div>
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
				<div class="jumpbar">
					<!--
					Show races from: <input type="text" id="date_filter" />
					<script type="text/javascript">
						<?php if ($lang !== 'en') { ?>
						$.datepicker.setDefaults($.datepicker.regional['<?php echo $lang ?>']);
						<?php } ?>
						$('#date_filter').datepicker({
							onSelect: function (date) {
								jg.admin.race_days.filterDate(date);
							},
							dateFormat: "yy/mm/dd",
							showStatus: true,
							showOn: "both",
							buttonImage: "/media/i/calendar16.png",
							buttonImageOnly: true
						});
					</script>
					-->
				</div>
			</div>
		</div>

		<div id="edit_detail">
			<div class="edit_content">
				<script type="text/javascript" src="/media/js/jquery.timeentry.js"></script>
				<form class="admin_form" id="race_day_admin<?php echo $method ?>_form" method="post" action="">
					<div class="submit_row">
						<h4 id="edit_message">Create New Race Day</h4>
						<a class="cancel" id="cancel_race" href="<?php echo $back_link ?>">cancel</a>
					</div>
					<div class="edit_row">
						<label for="date">day</label>
						<div class="entry"><input id="date" name="date" type="text" size="20" maxlength="40" value="<?php if (isset($edit->day_open)) echo date::reformat_to_timezone($edit->day_open, 'm/d/Y', $tz) ?>" /></div>
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
						<label for="time">pmu open</label>
						<div class="entry"><input id="day_open" name="day_open" type="text" size="20" maxlength="40" value="<?php if (isset($edit->day_open)) echo date::reformat_to_timezone($edit->day_open, 'H:i', $tz) ?>" /></div>
						<script type="text/javascript">
							$('#day_open').timeEntry({show24Hours: true, spinnerImage: '/media/i/buttons/time_entry.png', spinnerSize: [29, 29, 10]});
						</script>
					</div>
					<div class="edit_row">
						<label for="time">pmu close</label>
						<div class="entry"><input id="day_close" name="day_close" type="text" size="20" maxlength="40" value="<?php if (isset($edit->day_close)) echo date::reformat_to_timezone($edit->day_close, 'H:i', $tz) ?>" /></div>
						<script type="text/javascript">
							$('#day_close').timeEntry({show24Hours: true, spinnerImage: '/media/i/buttons/time_entry.png', spinnerSize: [29, 29, 10]});
						</script>
					</div>
					<div class="edit_row">
						<label for="time">jg open</label>
						<div class="entry"><input id="jg_open" name="jg_open" type="text" size="20" maxlength="40" value="<?php if (isset($edit->jg_open)) echo date::reformat_to_timezone($edit->jg_open, 'H:i', $tz) ?>" /></div>
						<script type="text/javascript">
							$('#jg_open').timeEntry({show24Hours: true, spinnerImage: '/media/i/buttons/time_entry.png', spinnerSize: [29, 29, 10]});
						</script>
					</div>
					<div class="edit_row">
						<label for="time">jg close</label>
						<div class="entry"><input id="jg_close" name="jg_close" type="text" size="20" maxlength="40" value="<?php if (isset($edit->jg_close)) echo date::reformat_to_timezone($edit->jg_close, 'H:i', $tz) ?>" /></div>
						<script type="text/javascript">
							$('#jg_close').timeEntry({show24Hours: true, spinnerImage: '/media/i/buttons/time_entry.png', spinnerSize: [29, 29, 10]});
						</script>
					</div>
					<div class="submit_row">
						<a class="submit" id="submit_race_days">create</a>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				$('#submit_race_days').click(function () {jg.admin.race_days.submit();});
			</script>
		</div>
	</div>
</div>
