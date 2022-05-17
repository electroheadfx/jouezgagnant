<?php

class Pages_Changes extends Migration
{
	public function up()
	{
		$this->remove_index('pages', 'page_language');
		$this->add_column('pages', 'title', array('string[80]', 'after' => 'name', 'null' => FALSE));
		$this->add_index('pages', 'page_name', array('language', 'name'), 'unique');
	}
	
	public function down()
	{
		$this->remove_index('pages', 'page_name');
		$this->remove_column('pages', 'title');
		$this->add_index('pages', 'page_language', 'language', 'normal');
	}
}