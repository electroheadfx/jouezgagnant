<?php

class Race_Day_Update extends Migration
{
	public function up()
	{
		$this->change_column('race_days', 'day_open', array('datetime', 'null' => FALSE));
		$this->change_column('race_days', 'day_close', array('datetime', 'null' => FALSE));
	}
	
	public function down()
	{
		$this->change_column('race_days', 'day_open', array('timestamp', 'null' => FALSE));
		$this->change_column('race_days', 'day_close', array('timestamp', 'null' => FALSE));
	}
}
