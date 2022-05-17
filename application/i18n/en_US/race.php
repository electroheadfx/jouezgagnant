<?php

$lang['adminedit'] = array
(
	'date' => array
	(
		'required' => 'Date is required',
	),
	
	'time' => array
	(
		'required' => 'Time is required',
	),
	
	'spot' => array
	(
		'required' => 'Spot is required',
		'standard_text' => 'The spot field contains invalid characters',
		'length' => 'Spot must be between 3 and 50 characters',
	),

	'pmu' => array
	(
		'required' => 'PMU is required',
		'numeric' => 'PMU must be a number',
	),

	'race' => array
	(
		'required' => 'Race # is required',
		'numeric' => 'Race # must be a number',
	),

	'first' => array
	(
		'numeric' => 'First pick must be a number',
	),

	'second' => array
	(
		'numeric' => 'Second pick must be a number',
	),

	'third' => array
	(
		'numeric' => 'Third pick must be a number',
	),

	'featured' => array
	(
		'default' => 'The featured field has a problem',
	),

	'horse' => array
	(
		'numeric' => 'Horse must be a number',
	),

	'horse_odds' => array
	(
		'numeric' => 'Horse odds must be a number',
	),

	'profit_50' => array
	(
		'numeric' => 'Profit 50 must be a number',
	),

	'profit_100' => array
	(
		'numeric' => 'Profit 100 odds must be a number',
	),
);

$lang['admincreate'] = $lang['adminedit'];