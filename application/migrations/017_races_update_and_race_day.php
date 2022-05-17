<?php

class Races_Update_And_Race_Day extends Migration
{
	public function up()
	{
		$this->add_column('races', 'horse2', array('integer[small]', 'null' => FALSE));
		$this->add_column('races', 'horse2_odds', array('decimal[8,2]', 'null' => FALSE));
		
		$this->create_table('race_days', array
			(
				'spot' => array('string[50]', 'null' => FALSE),
				'day_open' => array('timestamp', 'null' => FALSE),
				'day_close' => array('timestamp', 'null' => FALSE),
			)
		);
	}
	
	public function down()
	{
		$this->remove_column('races', 'horse2');
		$this->remove_column('races', 'horse2_odds');

		$this->drop_table('race_days');
	}
}
