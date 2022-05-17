<div id="content">
	<ul class="admin_nav">
		<li><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li class="selected"><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="media">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<a class="create" id="create_media" href="<?php echo url::site_lang('/admin/media/create') ?>">create</a>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">media id</div>
			<div class="interior">
				<div class="border"></div>
				<div class="path title">path</div>
				<div class="type title">type</div>
				<div class="uploaded title">date uploaded</div>
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
		
		<?php foreach ($media as $i => $md) : ?>
		<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label">
				<!-- <a class="edit" href="<?php echo url::site("/admin/media/edit/$md->id") ?>">edit</a> -->
				<a class="delete" href="<?php echo url::site("/admin/media/delete/$md->id") ?>">delete</a>
				<span><?php echo text::zero_pad($md->id, 5) ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="path data"><?php echo $md->path ?></div>
				<div class="type data"><?php echo $md->type ?></div>
				<div class="uploaded data"><?php echo date::reformat_readable($md->date_uploaded) ?></div>
				<div class="border"></div>
			</div>
			<div class="additional_thumb">
				<div class="thumb_display">
					<img src="<?php echo $md->path ?>" />
				</div>
			</div>
			<div class="thumb_shadow"></div>
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
				<form enctype="multipart/form-data" class="admin_form" id="media_admincreate_form" method="post">
					<div class="submit_row">
						<h4 id="edit_message">Create New Media Element</h4>
						<a class="cancel" id="cancel_media">cancel</a>
					</div>
					<!--<div class="edit_row">
						<label for="type">type</label>
						<div class="entry"><input id="type" name="type" type="text" size="12" maxlength="20" /></div>
					</div> -->
					<div class="edit_row">
						<label for="file">file</label>
						<div class="entry">
							<input type="file" name="file" id="file" size="30" />
						</div>
					</div>
					<div class="submit_row">
						<a class="submit" id="submit_media">create</a>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				$('#cancel_media').click(function () {jg.admin.media.cancel();});
				$('#submit_media').click(function () {jg.admin.media.submit();});
			</script>
		</div>
	</div>
</div>
