<?php

class Credit_And_Race_Changes extends Migration
{
	public function up()
	{
		$this->change_column('races', 'date', array('datetime', 'null' => FALSE));
		$this->add_column('races', 'pick_3', 'integer[small]');

		$this->add_column('orders', 'reference', array('string[20]', 'null' => FALSE));
		$this->add_column('orders', 'credits', array('integer[small]', 'null' => FALSE));
		$this->add_column('orders', 'process_date', 'datetime');
		$this->add_index('orders', 'reference', 'reference', 'unique');

		$this->drop_table('credits');

		$this->create_table
		(
			'credits', array
			(
				'user_id'		=> array('integer', 'null' => FALSE),
				'order_id'		=> array('integer', 'null' => FALSE),
				'expiry_date' 	=> array('datetime', 'null' => FALSE),
				'race_id'		=> 'integer',
				'pick_1'		=> 'integer[small]',
				'pick_2'		=> 'integer[small]',
				'pick_3'		=> 'integer[small]',
				'total_bet'		=> 'decimal[8,2]',
				'date_used' 	=> 'datetime',
			)
		);
	}
	
	public function down()
	{
		$this->drop_table('credits');
		
		$this->create_table
		(
			'credits', array
			(
				'order_id'	=> array('integer', 'null' => FALSE),
				'date_used'	=> array('date', 'null' => FALSE),
			)
		);

		$this->remove_index('orders', 'reference');
		$this->remove_column('orders', 'reference');
		$this->remove_column('orders', 'credits');
		$this->remove_column('orders', 'process_date');

		$this->change_column('races', 'date', array('date', 'null' => FALSE));
		$this->remove_column('races', 'pick_3');
	}
}