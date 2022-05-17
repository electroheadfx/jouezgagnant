<?php
/**
 * Windowed pagination style
 * 
 * @preview  previous showing 40 - 60 of 176 next
 */
?>

<div class="jumpbar">
	
	<?php if ($current_page > 1) : ?>
		<?php if ($current_page == 2) : ?>
			<a class="previous" href="<?php echo $base_url ?>">previous</a>
		<?php else : ?>
			<a class="previous" href="<?php echo str_replace('{page}', max(1, $current_page - 1), $url) ?>/<?php echo $items_per_page ?>">previous</a>
		<?php endif; ?>
	<?php else : ?>
		<a class="previousoff">previous</a>
	<?php endif; ?>

	<div class="count">showing <?php echo $current_first_item ?> - <?php echo $current_last_item ?> of <?php echo $total_items ?></div>

	<?php if ($current_page < $total_pages ) : ?>
		<a class="next" href="<?php echo str_replace('{page}', min($total_pages, $current_page + 1), $url) ?>/<?php echo $items_per_page ?>">next</a>
	<?php else : ?>
		<a class="nextoff">next</a>
	<?php endif; ?>

</div>
