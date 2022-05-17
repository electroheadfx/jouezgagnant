<div id="content">
	<ul class="admin_nav">
		<li><a href="<?php echo url::site_lang('/admin/race_days') ?>">race days</a></li>
		<li><a href="<?php echo url::site_lang('/admin/races') ?>">races</a></li>
		<li><a href="<?php echo url::site_lang('/admin/orders') ?>">orders</a></li>
		<li><a href="<?php echo url::site_lang('/admin/users') ?>">accounts</a></li>
		<li class="selected"><a href="<?php echo url::site_lang('/admin/pages') ?>">pages</a></li>
		<li><a href="<?php echo url::site_lang('/admin/media') ?>">media</a></li>
	</ul>
	<h2>Admin</h2>

	<div id="pages">
		<div class="actionbar">
			<div class="label" id="action_label">&nbsp;</div>
			<div class="interior" id="top_left">
				<div class="actions">
					<p id="status_message"></p>
					<a class="create" id="create_page" href="<?php echo url::site_lang('/admin/pages/create') ?>">create</a>
				</div>
			</div>
		</div>
		<div class="titlebar">
			<div class="label title">page name</div>
			<div class="interior">
				<div class="border"></div>
				<div class="active title">active</div>
				<div class="language title">language</div>
				<div class="content title">content</div>
				<div class="updated title">last_updated</div>
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
		
		<?php foreach ($pages as $pg) : ?>
		<div id="row_<?php echo text::zero_pad($pg->id, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
			<div class="label">
				<a class="edit" href="/admin/pages/edit/<?php echo $pg->id ?>">edit</a>
				<a class="delete" href="/admin/pages/delete/<?php echo $pg->id ?>">delete</a>
				<span><?php echo $pg->name ?></span>
			</div>
			<div class="interior">
				<div class="border"></div>
				<div class="active data"><?php echo $pg->active ? 'active' : 'inactive' ?></div>
				<div class="language data"><?php echo $pg->language ?></div>
				<div class="content data">
					<?php echo htmlentities(strlen($pg->content) > 40 ? (substr($pg->content, 0, 40) . '...') : $pg->content ) ?>
				</div>
				<div class="updated data"><?php echo date::reformat_std($pg->last_updated) ?></div>
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
				<form class="admin_form" id="page_admin<?php echo $method ?>_form" method="post">
					<div class="submit_row">
						<h4 id="edit_message">Create New Page</h4>
						<a class="cancel" id="cancel_page" href="<?php echo $back_link ?>">cancel</a>
					</div>
					<div class="edit_row">
						<label for="name">page name</label>
						<div class="entry"><input id="name" name="name" type="text" size="40" maxlength="60" value="<?php if (isset($edit->name)) echo $edit->name ?>"></div>
					</div>
					<div class="edit_row">
						<label for="name">page title</label>
						<div class="entry"><input id="title" name="title" type="text" size="40" maxlength="80" value="<?php if (isset($edit->title)) html::print_attr($edit->title) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="name">meta description</label>
						<div class="entry"><input id="meta" name="meta" type="text" size="60" maxlength="200" value="<?php if (isset($edit->meta)) html::print_attr($edit->meta) ?>"></div>
					</div>
					<div class="edit_row">
						<label for="name">stylesheet</label>
						<div class="entry"><input id="stylesheet" name="stylesheet" type="text" size="60" maxlength="200" value="<?php if (isset($edit->stylesheet)) echo $edit->stylesheet ?>"></div>
					</div>
					<div class="edit_row">
						<label for="active">active</label>
						<div class="entry"><input id="active" name="active" type="checkbox" <?php if (isset($edit->active)) echo 'checked' ?>></div>
					</div>
					<div class="edit_row">
						<label for="language">language</label>
						<div class="entry"><input id="language" name="language" type="text" size="6" maxlength="5" value="<?php if (isset($edit->language)) echo $edit->language ?>"></div>
					</div>
					<div class="edit_row">
						<label for="language">content</label>
						<div class="entry">
							<textarea name="content" rows="12" cols="40"><?php if (isset($edit->content)) echo $edit->content ?></textarea>
						</div>
					</div>
					<div class="submit_row">
						<a class="submit" id="submit_page">create</a>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				$('#submit_page').click(function () {jg.admin.pages.submit();});
			</script>
		</div>
	</div>
</div>
