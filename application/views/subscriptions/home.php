<div id="content">
	<p class="sidenote midRed"><?php echo Kohana::lang('subscriptions.note') ?></p>
	<h2>
		<?php echo Kohana::lang('subscriptions.conditions') ?>
	</h2>
	<p class="text">
		<?php echo Kohana::lang('subscriptions.condition_text') ?>
	</p>

	<h2><?php echo Kohana::lang('subscriptions.subscriptions') ?></h2>
	<div class="full_block">
		<ul class="table">
			<li>
				<span class="label"><?php echo Kohana::lang('subscriptions.1day') ?></span>
				<span class="notes"><?php echo Kohana::lang('subscriptions.1note') ?></span>
				<span class="rate">&euro;3,5</span>
				<?php echo html::anchor('/subscriptions/order?type=a', Kohana::lang('subscriptions.1day'), array('class' => 'greenButton')) ?>
			</li>
			<li class="even">
				<span class="label"><?php echo Kohana::lang('subscriptions.5days') ?></span>
				<span class="notes"><?php echo Kohana::lang('subscriptions.5note') ?></span>
				<span class="rate">&euro;12,5</span>
				<?php echo html::anchor('/subscriptions/order?type=b', Kohana::lang('subscriptions.5days'), array('class' => 'greenButton')) ?>
			</li>
			<li>
				<span class="label"><?php echo Kohana::lang('subscriptions.10days') ?></span>
				<span class="notes"><?php echo Kohana::lang('subscriptions.10note') ?></span>
				<span class="rate">&euro;19,5</span>
				<?php echo html::anchor('/subscriptions/order?type=c', Kohana::lang('subscriptions.10days'), array('class' => 'greenButton')) ?>
			</li>
			<li class="even">
				<span class="label"><?php echo Kohana::lang('subscriptions.30days') ?></span>
				<span class="notes"><?php echo Kohana::lang('subscriptions.30note') ?></span>
				<span class="rate">&euro;49,5</span>
				<?php echo html::anchor('/subscriptions/order?type=d', Kohana::lang('subscriptions.30days'), array('class' => 'greenButton')) ?>
			</li>
		</ul>
		<div class="spplus_window">
			<img src="/media/i/spplus.jpg" alt="spplus" width="155" height="218" />
		</div>
	</div>
	
	<p class="redNote">
		<?php echo Kohana::lang('subscriptions.pmu_note') ?>
	</p>
</div>
