<div id="intro_pane">
	<div class="content">
		<div class="leftCol">
			<div class="intro">
				<div class="headline"><?php echo Kohana::lang('info.headline') ?></div>
				<div class="subheadline"><?php echo Kohana::lang('info.play') ?></div>
				<div class="entryBlock">
					<p class="midBlue">
						<?php echo Kohana::lang('info.scorecard') ?>
					</p>
					<div class="dash"><img src="/media/i/visuals/dash1.jpg" alt="race photo" width="526" height="146"></div>
					
				</div>
				
				<div class="finalBlock">
					<p class="midBlue">
						<?php echo Kohana::lang('info.background') ?>
					</p>
					<p class="midRed">
						<?php echo Kohana::lang('info.imperative') ?>
					</p>
				</div>
				<div id="footerNav">
					<a href="<?php echo url::site_lang('/info/jouez') ?>" class="redButton medium right"><?php echo Kohana::lang('info.nextIntro') ?></a>
					<a href="<?php echo url::site_lang('/entry') ?>" class="redButton medium left"><?php echo Kohana::lang('info.prevIntro') ?></a>
				</div>
			</div>
		</div>
		
		<div class="rightCol">
			<img src="/media/i/visuals/homme1.jpg" alt="Happy face" />
		</div>
	</div>
</div>