<?php

class Pages_Language extends Migration
{
	public function up()
	{
		$this->remove_index('pages', 'page_name');
		$this->add_column('pages', 'language', array('string[8]', 'null' => FALSE));
		$this->add_index('pages', 'page_language', 'language', 'normal');
	}
	
	public function down()
	{
		$this->add_index('pages', 'page_name', 'name', 'unique');
		$this->remove_column('pages', 'language');
	}
}