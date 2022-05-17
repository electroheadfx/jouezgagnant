<?php

class Race_Day_Adds extends Migration
{
	public function up()
	{
		$this->remove_column('races', 'horse2');
		$this->remove_column('races', 'horse2_odds');

		$this->remove_column('race_days', 'spot');
		$this->add_column('race_days', 'jg_open', array('datetime', 'null' => FALSE));
		$this->add_column('race_days', 'jg_close', array('datetime', 'null' => FALSE));
	}
	
	public function down()
	{
		$this->add_column('races', 'horse2', array('integer[small]', 'null' => FALSE));
		$this->add_column('races', 'horse2_odds', array('decimal[8,2]', 'null' => FALSE));

		$this->add_column('race_days', 'spot', array('string[50]', 'null' => FALSE));
		$this->remove_column('race_days', 'jg_open');
		$this->remove_column('race_days', 'jg_close');
	}
}
