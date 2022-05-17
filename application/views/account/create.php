<div id="content">
	<div id="login_pane">
		<form method="post" action="" id="user_create_form">
			<div class="login_window">
				<div class="labels">
					<div class="cell"><?php echo Kohana::lang('account.email') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.password') ?></div>
					<div class="cell after"><?php echo Kohana::lang('account.confirm_password') ?></div>
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
						<div class="cell">
							<input type="text" id="email" name="email" value="<?php echo @$POST->email ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="password" id="password" name="password" value="<?php echo @$POST->password ?>" />
						</div>
					</div>
					<div class="data after">
						<div class="cell">
							<input type="password" id="password_confirm" name="password_confirm" value="<?php echo @$POST->password_confirm ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="first_name" name="first_name" value="<?php echo @$POST->first_name ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="last_name" name="last_name" value="<?php echo @$POST->last_name ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="address" name="address" value="<?php echo @$POST->address ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="address2" name="address2" value="<?php echo @$POST->address2 ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" id="city" name="city" value="<?php echo @$POST->city ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" class="small" id="postal_code" name="postal_code" value="<?php echo @$POST->postal_code ?>" />
						</div>
					</div>
					<div class="data">
						<div class="cell">
							<input type="text" class="small" id="birth_date_day" name="birth_date_day" value="<?php echo @$POST->birth_date_day ?>" />
							<select id="birth_date_month" name="birth_date_month">
								<option value="01">Jan</option>
								<option value="02">Feb</option>
								<option value="03">Mar</option>
								<option value="04">Apr</option>
								<option value="05">May</option>
								<option value="06">Jun</option>
								<option value="07">Jul</option>
								<option value="08">Aug</option>
								<option value="09">Sep</option>
								<option value="10">Oct</option>
								<option value="11">Nov</option>
								<option value="12">Dec</option>
							</select>
							<select id="birth_date_year" name="birth_date_year">
								<?php for ($year = 1900; $year <= date('Y'); $year++) : ?>
								<option value="<?php echo $year ?>"<?php if ($year === 1990) { echo " selected"; } ?>><?php echo $year ?></option>
								<?php endfor; ?>
							</select>
						</div>
					</div>
					<div class="data">
						<div class="cell"><input id="login_submit" type="submit" value="<?php echo Kohana::lang('account.create') ?>" /></div>
					</div>
				</div>
				<div class="bottom">
					<div class="label_push">&nbsp;</div>
					<div class="bottom_note"><a href="<?php echo url::site_lang('/account/login') ?>"><?php echo Kohana::lang('account.opt_login') ?></a></div>
				</div>
			</div>
		</form>
	</div>
</div>
