<div class="main_container">
	<div class="content">
		<h2 class="">
			<?php echo Kohana::lang('intro.previous_results') ?>
			<a href="<?php echo url::site_lang('/entry') ?>" class="redButton medium right"><?php echo Kohana::lang('intro.enter2') ?></a>
		</h2>
		<?php echo Kohana::lang('intro.prev_results_text') ?>
		<?php if (is_object($races)) { ?>
			<div id="race_results">
				<div class="titlebar">
					<div class="label title"><?php echo Kohana::lang('intro.date') ?></div>
					<div class="interior">
						<div class="border"></div>
						<div class="spot title"><?php echo Kohana::lang('intro.spot') ?></div>
						<div class="race title"><?php echo Kohana::lang('intro.race') ?></div>
						<div class="horse title"><?php echo Kohana::lang('intro.horse') ?></div>
						<div class="odds title"><?php echo Kohana::lang('intro.odds') ?></div>
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
				
				<?php
					$total = 0;
					foreach ($races as $i => $rc) {
						if ($rc->race == 0) { continue; }
						$total += $rc->profit_100;
				?>
				<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?>">
					<div class="label">
						<span><?php echo date::date_in_language($rc->date, '%d %B, %Y') ?></span>
					</div>
					<div class="interior">
						<div class="border"></div>
						<div class="spot data"><?php echo $rc->spot ?></div>
						<div class="race data"><?php echo $rc->race ?></div>
						<div class="horse data"><?php echo $rc->horse ?></div>
						<div class="odds data"><?php echo $rc->horse_odds ?></div>
						<div class="border"></div>
					</div>
				</div>
				<?php } ?>
				
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
						<div class="jumpbar">&nbsp;</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
