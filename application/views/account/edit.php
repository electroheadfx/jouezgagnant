<div id="content">
	<div id="login_pane">
		<form method="post" action="" id="user_edit_form">
			<div class="login_window">
				<div class="labels">
<?php /* ?>
					<div class="cell"><?php echo Kohana::lang('account.email') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.password') ?></div>
					<div class="cell after"><?php echo Kohana::lang('account.confirm_password') ?></div>
<?php */ ?>
					<div class="cell"><?php echo Kohana::lang('account.firstname') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.lastname') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.address1') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.address2') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.city') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.postal_code') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.birth_date') ?></div>
				</div>
				<div class="interior">
<?php /* ?>
					<div class="data">
						<div class="cell">
							<input type="text" id="email" name="email" value="<?php echo $edit->email ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="password" id="password" name="password" value="" />
						</div>
					</div>
					<div class="data after">
						<div class="cell">
							<input type="password" id="password_confirm" name="password_confirm" value="" />
						</div>
					</div>
<?php */ ?>
					<div class="data">
						<div class="cell">
							<input type="text" id="first_name" name="first_name" value="<?php echo $edit->first_name ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="last_name" name="last_name" value="<?php echo $edit->last_name ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="address" name="address" value="<?php echo $edit->address ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="address2" name="address2" value="<?php echo $edit->address2 ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="city" name="city" value="<?php echo $edit->city ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" class="small" id="postal_code" name="postal_code" value="<?php echo $edit->postal_code ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<?php
								$bd = strtotime($edit->birth_date);
								$bd_day = date('j', $bd);
								$bd_month = date('m', $bd);
								$bd_year = date('Y', $bd);
							?>
							<input type="text" class="small" id="birth_date_day" name="birth_date_day" value="<?php echo $bd_day ?>" />
							<select id="birth_date_month" name="birth_date_month">
								<?php foreach ($months as $id => $name) {
									$state = ($bd_month == $id) ? ' selected' : '';
									echo "<option value=\"{$id}\"{$state}>{$name}</option>";
								}
								?>
							</select>
							<select id="birth_date_year" name="birth_date_year">
								<?php
									for ($year = 1900; $year <= date('Y'); $year++) {
										$state = ($year == $bd_year) ? ' selected' : '';
										echo "<option value=\"{$year}\"{$state}>{$year}</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="data">
						<div class="cell"><input id="login_submit" type="submit" value="edit" /></div>
					</div>
				</div>
				<div class="bottom">
					<div class="label_push">&nbsp;</div>
					<div class="bottom_note">or <a href="<?php echo url::site_lang('/account') ?>">cancel</a></div>
				</div>
			</div>
		</form>
	</div>
</div>
