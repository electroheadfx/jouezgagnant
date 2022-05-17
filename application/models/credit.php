<?php

class Credit_Model extends ORM	{
	
	public $belongs_to = array('user', 'order', 'race');

	/**
	 * Creates a new credit row
	 *
	 * @chainable
	 * @param   Order_Model  Parent of this credit
	 * @return  Credit_Model
	 */
	public function create($order)	
	{
		$this->user_id = Kohana::$instance->user->id;
		$this->order_id = $order->id;
		$this->expiry_date = date::reformat('Y-m-d 23:59', "+{$order->expiry} days");

		return $this->save();
	}
	
	/**
	 * Uses up a credit
	 *
	 * @chainable
	 * @return  Credit_Model
	 */
	public function consume()
	{
		$this->date_used = date::reformat_datetime();
		return $this->save();
	}
	
	/**
	 * Returns credit a user has purchased today (if any)
	 *
	 * @chainable
	 * @param   integer  User id of the user to check
	 * @return  Credit_Model 
	 */
	public function today($user_id)
	{
		return $this->where('user_id', $user_id)
			->where('date(`date_used`) = "' . date('Y-m-d'). '"')
			->where('active', TRUE)
			->find();
	}
	
	/**
	 * Get the next free credit (if any) for a given user
	 *
	 * @chainable
	 * @param   integer  User id of the user to check
	 * @return  Credit_Model 
	 */
	public function get_next($user_id)
	{
		return $this->where('user_id', $user_id)
			->where('expiry_date >', date::reformat_datetime())
			->where('date_used', NULL)
			->orderby('expiry_date')
			->where('active', TRUE)
			->find();
	}
}