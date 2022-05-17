<?php

class Order_Amount_Varchar extends Migration {
	
	public function up()
	{
		$this->change_column('orders', 'amount', array('string[20]', 'null' => FALSE));
		$this->add_column('orders', 'expiry', array('integer[small]', 'null' => FALSE, 'after' => 'credits'));
	}
		
	public function down()
	{
		$this->change_column('orders', 'amount', array('decimal[8,2]', 'null' => FALSE));
		$this->remove_column('orders', 'expiry');
	}
}