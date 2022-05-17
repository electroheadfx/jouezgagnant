<?php

$lang['admincreate'] = array
(
	'name' => array
	(
		'required' => 'Page name is required',
		'alpha_dash' => 'Page name contains invalid characters',
		'length' => 'Page name must be between 4 and 40 characters',
		'default' => 'The page name field has a problem',
	),
	
	'title' => array
	(
		'required' => 'Title is required',
		'standard_text' => 'Title contains invalid characters',
		'length' => 'Title must be between 3 and 80 characters',
		'default' => 'The title field has a problem',
	),
	
	'content' => array
	(
		'required' => 'Content is required',
		'default' => 'The content field has a problem',
	),
	
	'language' => array
	(
		'required' => 'Language is required',
		'language' => 'Language must be en or fr',
		'default' => 'The language has a problem',
	),
	
	'active' => array
	(
		'default' => 'The active field has a problem',
	),
);

$lang['adminedit'] = $lang['admincreate'];