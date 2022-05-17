<div id="content">
	<?php if (!empty($active)) { ?>
	<div id="predictions">
		<div id="calcpane">
			<div class="profit">
				<div class="emulation">
					<div class="desc"><?php echo Kohana::lang('predictions.goal') ?></div>
					<div class="support">
						<a id="emulation_down" class="button">down</a>
						<input id="emulation_amount" type="text" value="40" />
						<a id="emulation_up" class="button">up</a>
					</div>
					<script type="text/javascript">
						$('#emulation_down').click(function () { jg.predictions.adjust_emu('down'); });
						$('#emulation_up').click(function () { jg.predictions.adjust_emu('up'); });
					</script>
				</div>
				<div class="seek">
					<div class="desc"><?php echo Kohana::lang('predictions.return') ?></div>
					<div id="seek_amount" class="support entry">100.00</div>
				</div>
			</div>
			<div class="details">
				<div class="item course">
					<div class="desc"><?php echo Kohana::lang('predictions.race') ?></div>
					<?php
					foreach ($race_list as $race) {
						if ($race->race == 0) { continue; }
						if ($race->race === $active->race && $race->pmu === $active->pmu) {
							echo "<div class=\"data active\">{$race->race}</div>";
						} else {
							echo "<div class=\"data\">{$race->race}</div>";
						}
					}
					?>
				</div>
				<div class="item">
					<div class="desc"><?php echo Kohana::lang('predictions.date') ?></div>
					<div class="data"><?php echo date::date_in_language($active->date, '%d %B, %Y') ?></div>
				</div>
				<div class="item">
					<div class="desc"><?php echo Kohana::lang('predictions.time') ?></div>
					<div class="data"><?php echo date::reformat_to_timezone($active->date, 'G:i', $this->user->timezone) ?></div>
				</div>
				<div class="item">
					<div class="desc"><?php echo Kohana::lang('predictions.spot') ?></div>
					<div class="data"><?php echo $active->spot ?></div>
				</div>
				<div class="item">
					<div class="desc"><?php echo Kohana::lang('predictions.pmu') ?></div>
					<div class="data"><?php echo $active->pmu ?></div>
				</div>
			</div>
		</div>
		<div id="calculations">
			<div class="titlebar">
				<div class="label title">
					<?php echo date::reformat_to_timezone(date('Y-m-d H:i:s'), 'G:i', $this->user->timezone); ?>
					--
					<?php echo date::date_in_language(date('Y-m-d H:i:s'), '%d %B, %Y') ?>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="races_combined title last"><?php echo Kohana::lang('predictions.to_play') ?></div>
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
	
			<div id="jg_entry" class="datarow jg">
				<div class="label">
					<span><?php echo Kohana::lang('predictions.jgpicks') ?></span>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="race data"><div id="jg1" class="entry">
						<?php echo $active->first ?>
					</div></div>
					<div class="race data"><div id="jg2" class="entry">
						<?php echo $active->second ?>
					</div></div>
					<div class="race last data"><div id="jg3" class="entry">
						<?php echo $active->third ?>
					</div></div>
					<div class="border"></div>
				</div>
			</div>
	
			<div id="row_000" class="datarow odd">
				<div class="label">
					<span><?php echo Kohana::lang('predictions.picks') ?></span>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="race data"><input id="pp1" type="text" value="" /></div>
					<div class="race data"><input id="pp2" type="text" value="" /></div>
					<div class="race last data"><input id="pp3" type="text" value="" /></div>
					<div class="border"></div>
				</div>
			</div>
			<div id="row_001" class="datarow even">
				<div class="label">
					<span><?php echo Kohana::lang('predictions.odds10') ?></span>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="race data"><input id="odd1" type="text" value="" /></div>
					<div class="race data"><input id="odd2" type="text" value="" /></div>
					<div class="race last data"><input id="odd3" type="text" value="" /></div>
					<div class="border"></div>
				</div>
			</div>
			<div id="row_002" class="datarow odd">
				<div class="label">
					<span class="partner"><?php echo Kohana::lang('predictions.bet') ?></span>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="race data"><div id="euro1" class="entry euro">&nbsp;</div></div>
					<div class="race data"><div id="euro2" class="entry euro">&nbsp;</div></div>
					<div class="race last data"><div id="euro3" class="entry euro">&nbsp;</div></div>
					<div class="border"></div>
				</div>
			</div>
			<div id="row_003" class="datarow even">
				<div class="label">
					<span class="total"><?php echo Kohana::lang('predictions.total') ?></span>
				</div>
				<div class="interior">
					<div class="border"></div>
					<div class="race data"><div id="totalbet" class="entry euro">&nbsp;</div></div>
					<div class="race data"></div>
					<div class="race last data"></div>
					<div class="border"></div>
				</div>
			</div>
			<script type="text/javascript">
				$('#emulation_amount').blur(function () { jg.predictions.calculate(); });
				$('#pp1').blur(function () { jg.predictions.calculate(); });
				$('#pp2').blur(function () { jg.predictions.calculate(); });
				$('#pp3').blur(function () { jg.predictions.calculate(); });
				$('#odd1').blur(function () { jg.predictions.calculate(); });
				$('#odd2').blur(function () { jg.predictions.calculate(); });
				$('#odd3').blur(function () { jg.predictions.calculate(); });
			</script>
			
			<div class="bottompad">
				<div class="label">&nbsp;</div>
				<div class="interior">
					<div class="border"></div>
					<div class="bottomcurves"></div>
					<div class="border"></div>
				</div>
			</div>
			<div class="bottombar">
				<div class="label">
					<a href="<?php echo url::site_lang('/predictions') ?>" class="greenButton wide"><?php echo Kohana::lang('predictions.refresh') ?></a>
				</div>
				<div class="interior">
				</div>
			</div>
		</div>
	</div>

	<div id="pmu_pane">
		<div id="info_handle" class="button on">
			<a id="info_toggle"><?php echo Kohana::lang('predictions.how') ?></a>
		</div>
		<div id="pmu_handle" class="button off">
			<a id="pmu_toggle"><?php echo Kohana::lang('predictions.pmu_access') ?></a>
		</div>
		<div id="today_handle" class="button off">
			<a id="today_toggle"><?php echo Kohana::lang('predictions.todays_races') ?></a>
		</div>
		<div id="info_display" class="pmu_container">
			<div class="how_frame">
				<div class="how_row">
					<div class="how_item">
						<div class="how_step">
							<div class="number">1</div>
							<div class="label"><?php echo Kohana::lang('predictions.step1title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step1') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step1.png" width="271" height="49"></div>
						</div>
					</div>
					<div class="how_item">
						<div class="how_step">
							<div class="number">2</div>
							<div class="label"><?php echo Kohana::lang('predictions.step2title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step2') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step2.gif" width="221" height="66"></div>
						</div>
					</div>
				</div>
				<div class="how_row">
					<div class="how_item">
						<div class="how_step">
							<div class="number">3</div>
							<div class="label"><?php echo Kohana::lang('predictions.step3title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step3') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step3.png" width="270" height="123"></div>
						</div>
					</div>
					<div class="how_item">
						<div class="how_step">
							<div class="number">4</div>
							<div class="label"><?php echo Kohana::lang('predictions.step4title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step4') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step4.png" width="358" height="87"></div>
						</div>
					</div>
				</div>
				<div class="how_row last">
					<div class="how_item">
						<div class="how_step">
							<div class="number">5</div>
							<div class="label"><?php echo Kohana::lang('predictions.step4title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step5') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step5.png" width="195" height="113"></div>
						</div>
					</div>
					<div class="how_item">
						<div class="how_step">
							<div class="number">6</div>
							<div class="label"><?php echo Kohana::lang('predictions.step4title') ?></div>
						</div>
						<div class="how_info">
							<div class="desc">
								<img class="tall" src="/media/i/green_arrow.png" width="24" height="24">
								<?php echo Kohana::lang('predictions.step6') ?>
							</div>
							<div class="image"><img src="/media/i/how_to/step6.png" width="358" height="106"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="pmu_display" class="pmu_container">
			<div class="pmu_frame">
				<iframe src="http://www.pmu.fr/" frameborder="0" width="100%" scrolling="auto" height="532"></iframe>
			</div>
		</div>
		<div id="today_display" class="pmu_container">
			<div class="today_frame">

				<div id="todays_races">
					<div class="titlebar">
						<div class="label title"><?php echo Kohana::lang('predictions.time') ?></div>
						<div class="interior">
							<div class="border"></div>
							<div class="spot title"><?php echo Kohana::lang('predictions.spot') ?></div>
							<div class="pmu title"><?php echo Kohana::lang('predictions.pmu') ?></div>
							<div class="race title"><?php echo Kohana::lang('predictions.race') ?></div>
							<div class="races_combined title"><?php echo Kohana::lang('predictions.to_play') ?></div>
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
						foreach ($race_list as $i => $rc) {
							if ($rc->race == 0) { continue; }
							$n = '';
							if ($rc->race === $active->race && $rc->pmu === $active->pmu) {
								$n = ' active';
							}
					?>
					<div id="row_<?php echo text::zero_pad($i, 3) ?>" class="datarow <?php echo text::alternate('odd', 'even') ?><?php echo $n ?>">
						<div class="label">
							<span><?php echo date::reformat_to_timezone($rc->date, 'H:i', $this->user->timezone) ?></span>
						</div>
						<div class="interior">
							<div class="border"></div>
							<div class="spot data"><?php echo $rc->spot ?></div>
							<div class="pmu data"><?php echo $rc->pmu ?></div>
							<div class="race data"><?php echo $rc->race ?></div>
							<div class="first data"><?php echo $rc->first ?></div>
							<div class="second data"><?php echo $rc->second ?></div>
							<div class="third data"><?php echo $rc->third ?></div>
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
			
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#info_toggle').click(function () { jg.predictions.toggle_pmu('info'); });
		$('#pmu_toggle').click(function () { jg.predictions.toggle_pmu('pmu'); });
		$('#today_toggle').click(function () { jg.predictions.toggle_pmu('today'); });
	</script>
	<?php } else { ?>
	<div id="message_pane">
		No races are active at this time.
	</div>
	<?php } ?>
</div>
