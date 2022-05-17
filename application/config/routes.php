<?php 

$lang = '[a-zA-Z]{2}';

// Routes begin with a language code
$config['_default'] = 'home';
$config[$lang] = 'home';
$config["$lang/intro"] = 'home/intro';
$config["$lang/entry"] = 'home/entry';
$config["$lang/results"] = 'home/results';
$config["$lang/(.*)"] = '$1';

