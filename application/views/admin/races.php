<div id="content">
	<ul class="admin_nav">
		<li><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li class="selected"><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="races">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<a class="create" id="create_race" href="<?php echo url::site_lang('/admin/races/create') ?>">create</a>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">internal race id</div>
			<div class="interior">
				<div class="border"></div>
				<div class="date title">date</div>
				<div class="time title">time</div>
				<div class="spot title">spot</div>
				<div class="pmu title">r&eacute;union</div>
				<div class="race title">race n&deg;</div>
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
		
		<?php foreach ($races as $i => $rc) : ?>
		<?php $f = ($rc->featured === 1) ? ' featured' : ''; ?>
		<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label<?php echo $f ?>">
				<a class="edit" href="/admin/races/edit/<?php echo $rc->id ?>">edit</a>
				<a class="delete" href="/admin/races/delete/<?php echo $rc->id ?>">delete</a>
				<span><?php echo $rc->id ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="date data"><?php echo date::reformat_to_timezone($rc->date, 'M j, Y', $tz) ?></div>
				<div class="time data"><?php echo date::reformat_to_timezone($rc->date, 'H:i', $tz) ?></div>
				<div class="spot data"><?php echo $rc->spot ?></div>
				<div class="pmu data"><?php echo $rc->pmu ?></div>
				<div class="race data"><?php echo $rc->race ?></div>
				<div class="border"></div>
			</div>
			<div class="additional">
				<div class="border"></div>
				<div class="add_data">
					<div class="single_race">
						<span class="single_label">1<sup>st</sup> pick: </span>
						<span class="single_entry"><?php echo $rc->first ?></span>
					</div>
					<div class="single_race">
						<span class="single_label">2<sup>nd</sup> pick: </span>
						<span class="single_entry"><?php echo $rc->second ?></span>
					</div>
					<div class="single_race">
						<span class="single_label">3<sup>rd</sup> pick: </span>
						<span class="single_entry"><?php echo $rc->third ?></span>
					</div>
					<?php if (!empty($rc->horse)) { ?>
					<div class="single_race">
						<span class="single_label">horse (odds): </span>
						<span class="single_entry"><?php echo $rc->horse ?> (<?php echo $rc->horse_odds ?>)</span>
					</div>
					<?php } ?>
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
				<div class="jumpbar">
					Show races from: <input type="text" id="date_filter" />
					<script type="text/javascript">
						<?php if ($lang !== 'en') { ?>
						$.datepicker.setDefaults($.datepicker.regional['<?php echo $lang ?>']);
						<?php } ?>
						$('#date_filter').datepicker({
							onSelect: function (date) {
								jg.admin.races.filterDate(date);
							},
							dateFormat: "yy/mm/dd",
							showStatus: true,
							showOn: "both",
							buttonImage: "/media/i/calendar16.png",
							buttonImageOnly: true
						});
					</script>
				</div>
			</div>
		</div>

		<div id="edit_detail">
			<div class="edit_content">
				<script type="text/javascript" src="/media/js/jquery.timeentry.js"></script>
				<form class="admin_form" id="race_admin<?php echo $method ?>_form" method="post" action="">
					<div class="submit_row">
						<h4 id="edit_message">Create New Race</h4>
						<a class="cancel" id="cancel_race" href="<?php echo $back_link ?>">cancel</a>
					</div>
					<div class="edit_row">
						<label for="date">date</label>
						<div class="entry"><input id="date" name="date" type="text" size="20" maxlength="40" value="<?php if (isset($edit->date)) echo date::reformat_to_timezone($edit->date, 'm/d/Y', $tz) ?>" /></div>
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
						<div class="entry"><input id="time" name="time" type="text" size="20" maxlength="40" value="<?php if (isset($edit->date)) echo date::reformat_to_timezone($edit->date, 'H:i', $tz) ?>" /></div>
						<script type="text/javascript">
							$('#time').timeEntry({show24Hours: true, spinnerImage: '/media/i/buttons/time_entry.png', spinnerSize: [29, 29, 10]});
						</script>
					</div>
					<div class="edit_row">
						<label for="spot">spot</label>
						<div class="entry"><input id="spot" name="spot" type="text" size="40" maxlength="60" value="<?php if (isset($edit->spot)) echo $edit->spot ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="pmu">r&eacute;union</label>
						<div class="entry"><input id="pmu" name="pmu" type="text" size="5" maxlength="3" value="<?php if (isset($edit->pmu)) echo $edit->pmu ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="pmu">race n&deg;</label>
						<div class="entry"><input id="race" name="race" type="text" size="5" maxlength="3" value="<?php if (isset($edit->race)) echo $edit->race ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="pmu">1st pick</label>
						<div class="entry"><input id="first" name="first" type="text" size="8" maxlength="3" value="<?php if (isset($edit->first)) echo $edit->first ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="pmu">2nd pick</label>
						<div class="entry"><input id="second" name="second" type="text" size="8" maxlength="3" value="<?php if (isset($edit->second)) echo $edit->second ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="pmu">3rd pick</label>
						<div class="entry"><input id="third" name="third" type="text" size="8" maxlength="3" value="<?php if (isset($edit->third)) echo $edit->third ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="featured">featured</label>
						<div class="entry"><input id="featured" name="featured" type="checkbox" <?php if (isset($edit->featured)) if ($edit->featured) echo 'checked' ?> /></div>
					</div>
					<div class="edit_row">
						<label for="horse">horse</label>
						<div class="entry"><input id="horse" name="horse" type="text" size="8" maxlength="3" value="<?php if (isset($edit->horse)) echo $edit->horse ?>" /></div>
					</div>
					<div class="edit_row">
						<label for="horse_odds">horse's odds</label>
						<div class="entry"><input id="horse_odds" name="horse_odds" type="text" size="9" maxlength="9" value="<?php if (isset($edit->horse_odds)) echo $edit->horse_odds ?>" /></div>
					</div>
					<div class="submit_row">
						<a class="submit" id="submit_race">create</a>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				$('#submit_race').click(function () {jg.admin.races.submit();});
			</script>
		</div>
	</div>
</div>
