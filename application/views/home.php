<div id="home_pane">
	<div class="content">
		<div class="leftCol">
			<div class="intro">
				<?php echo Kohana::lang('intro.home') ?>
				<a href="<?php echo url::site_lang('/entry') ?>" class="redButton medium right"><?php echo Kohana::lang('intro.enter') ?></a>
			</div>
			<div class="overview">
				<div class="race_pane">
					<div class="race_info">
						<div class="race_details">
							<div class="label">
								<?php echo Kohana::lang('intro.today') ?>
							</div>
							<div class="spot">
								<?php echo $spot ?>
								<?php if ($spot !== 'TBD') { ?>
								- <?php echo date::reformat_to_timezone($race_day->day_open, 'G:i', $tz) ?> <?php echo Kohana::lang('intro.to') ?> <?php echo date::reformat_to_timezone($race_day->day_close, 'G:i', $tz) ?>
								<?php } ?>
							</div>
						</div>
						<div class="account_button">
							<?php $p = ($user) ? '/account' : '/account/login'; ?>
							<a href="<?php echo url::site_lang($p) ?>" class="redButton medium"><?php echo Kohana::lang('intro.my_account') ?></a>
						</div>
					</div>
					<div class="race_list">
						<div class="midGreen">
							<?php echo Kohana::lang('intro.todays_races') ?>
						</div>
						<?php
							for ($i = 1; $i <= 9; $i++) {
								$state = (in_array($i, $active_races)) ? ' active' : ' inactive' ;
								echo "<div class=\"race_num{$state}\">{$i}</div>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="rightCol">
			<div class="widget">
				<p><?php echo Kohana::lang('intro.widget') ?></p>
				<img src="/media/i/home/predictions_sample.png" width="233" height="128">
				<p><?php echo Kohana::lang('intro.widget_info') ?></p>
			</div>
			<div class="widget last">
				<h4 class="tableHead"><?php echo Kohana::lang('intro.previous_result') ?></h4>
				<div class="resultbutton"><a href="<?php echo url::site_lang('/results') ?>" class="greenButton"><?php echo Kohana::lang('intro.detail') ?></a></div>
				<div class="raceData">
					<div class="labels">
						<div class="item narrow"><?php echo Kohana::lang('intro.date') ?></div>
						<div class="item wide"><?php echo Kohana::lang('intro.spot') ?></div>
						<div class="item mini last"><?php echo Kohana::lang('intro.group') ?></div>
					</div>
					<div class="results">
						<div class="item narrow"><?php echo date::reformat_short($race1->date) ?></div>
						<div class="item wide"><?php echo $race1->spot ?></div>
						<div class="item mini last">R<?php echo $race1->pmu ?></div>
					</div>
				</div>
				<div class="raceInfo">
					<div class="horseInfo">
						<div class="interior">
							<div class="title">
								<div class="cell"><?php echo Kohana::lang('intro.horse') ?></div>
								<div class="cell"><?php echo Kohana::lang('intro.race') ?></div>
								<div class="cell"><?php echo Kohana::lang('intro.odds') ?></div>
							</div>
							<div class="data">
								<div class="cell"><?php echo $race1->horse ?></div>
								<div class="cell"><?php echo $race1->race ?></div>
								<div class="cell"><?php echo $race1->horse_odds ?></div>
							</div>
							<?php if ($race2 !== false) { ?>
							<div class="divider">
								<div class="cell">&nbsp;</div>
								<div class="cell">&nbsp;</div>
								<div class="cell">&nbsp;</div>
							</div>
							<div class="data">
								<div class="cell"><?php echo $race2->horse ?></div>
								<div class="cell"><?php echo $race2->race ?></div>
								<div class="cell"><?php echo $race2->horse_odds ?></div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
