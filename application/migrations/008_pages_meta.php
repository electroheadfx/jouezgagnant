<?php

class Pages_Meta extends Migration
{
	public function up()
	{
		$this->add_column('pages', 'meta', array('string[200]', 'after' => 'title', 'null' => FALSE));
		$this->add_column('pages', 'stylesheet', array('string[200]', 'after' => 'meta', 'null' => FALSE));
	}
	
	public function down()
	{
		$this->remove_column('pages', 'meta');
		$this->remove_column('pages', 'stylesheet');
	}
}