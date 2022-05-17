<?php

class Initialization extends Migration
{
	public function up()
	{
		$this->create_table
		(
			'users', array
			(
				'email' 		=> array('string[50]', 'null' => FALSE),
				'first_name' 	=> array('string[40]', 'null' => FALSE),
				'last_name' 	=> array('string[40]', 'null' => FALSE),
				'password' 		=> array('string[50]', 'null' => FALSE),
				'address' 		=> array('string[50]', 'null' => FALSE),
				'address2' 		=> array('string[50]'),
				'city' 			=> array('string[50]', 'null' => FALSE),
				'postal_code' 	=> array('string[15]', 'null' => FALSE),
				'birth_date' 	=> array('date', 'null' => FALSE),
			)
		);
		
		$this->add_index('users', 'email', 'email', 'unique');
		
		$this->create_table
		(
			'orders', array
			(
				'user_id'	=> array('integer', 'null' => FALSE),
				'date'		=> array('datetime', 'null' => FALSE),
				'amount'	=> array('decimal[8,2]', 'null' => FALSE),
				'status'	=> array('string[1]', 'null' => FALSE, 'default' => 'P'),
			)
		);
		
		$this->add_index('orders', 'user_id', 'user_id');
		
		$this->create_table
		(
			'credits', array
			(
				'order_id'	=> array('integer', 'null' => FALSE),
				'date_used'	=> array('date', 'null' => FALSE),
			)
		);
		
		$this->add_index('credits', 'order_id', 'order_id');
		
		$this->create_table
		(
			'races', array
			(
				'date'			=> array('date', 'null' => FALSE),
				'spot'			=> array('string[50]', 'null' => FALSE),
				'pmu_meet_num'	=> array('integer[small]', 'null' => FALSE),
				'race_num'		=> array('integer[small]', 'null' => FALSE),
				'pick_1'		=> array('integer[small]'),
				'pick_2'		=> array('integer[small]'),
				'pick_2'		=> array('integer[small]'),
			)
		);
	}
	
	public function down()
	{
		$this->drop_table('users');
		$this->drop_table('orders');
		$this->drop_table('credits');
		$this->drop_table('races');
	}
}