<?php

class Featured_Race_Additions extends Migration
{
	public function up()
	{
		$this->add_column('races', 'featured', array('boolean', 'default' => TRUE, 'null' => FALSE));
		$this->add_column('races', 'horse', array('integer[small]', 'null' => FALSE));
		$this->add_column('races', 'horse_odds', array('decimal[8,2]', 'null' => FALSE));
		$this->add_column('races', 'profit_50', array('decimal[8,2]', 'null' => FALSE));
		$this->add_column('races', 'profit_100', array('decimal[8,2]', 'null' => FALSE));

		$this->add_index('races', 'featured', 'featured', 'normal');

	}
	
	public function down()
	{
		$this->remove_index('races', 'featured');

		$this->remove_column('races', 'featured');
		$this->remove_column('races', 'horse');
		$this->remove_column('races', 'horse_odds');
		$this->remove_column('races', 'profit_50');
		$this->remove_column('races', 'profit_100');
	}
}