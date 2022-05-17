<?php

class Order_Model extends ORM
{
	public $belongs_to = array('user');
	public $has_many = array('credit');
	
	public $errors;

	public function __construct($id = NULL)
	{
		parent::__construct($id);

		// Force loading of SPPLUS
		if ( ! extension_loaded('SPPLUS')) 
		{ 
			@dl('php_spplus.so'); 
		}
	}

	/**
	 * Creates a new order
	 *
	 * @chainable
	 * @param   array   Information about the order, such as amount, credits and expiry
	 * @return  Order_Model   New order object
	 */
	public function create($order_info)
	{
		$this->user_id 		= Kohana::$instance->user->id;
		$this->date 		= date('Y-m-d');
		$this->amount 		= $order_info['amount'];
		$this->status 		= 'P';
		$this->reference 	= 'spp' . date('YmdHis'); // order reference, should be unique
		$this->credits 		= $order_info['credits'];
		$this->expiry		= $order_info['expiry'];

		return $this->save();
	}

	/**
	 * Get the spplus payment url to go along with this order
	 *
	 * @return  string  URL of the spplus payment gateway
	 */
	public function spplus_url()
	{
		// generate spplus url
		$url = Kohana::config('payment.spplus.payment_url') . '?' . http_build_query($this->spplus_params());
		
		// error_log("string is " . implode('', $this->spplus_params()));
		// error_log("hmac is " . nthmac(Kohana::config('payment.spplus.clent'), implode('', $this->spplus_params())));
		
		return signeurlpaiement(Kohana::config('payment.spplus.clent'), $url);
	}

	/**
	 * Returns an array of spplus parameters for this order
	 *
	 * @return  array  Array of keys and values
	 */
	protected function spplus_params()
	{
		return array
		(
			'siret' 	=> Kohana::config('payment.spplus.codesiret'),
			'reference' => $this->reference,
			'langue' 	=> strtoupper(Kohana::config('locale.lang')),
			'devise' 	=> '978', // euro
			'montant' 	=> $this->amount,
			'taxe' 		=> '0.0',
			'moyen' 	=> 'CBS', // bank card
			'modalite' 	=> '1x',
			'email' 	=> Kohana::$instance->user->email,
			'urlretour' => url::site('/subscriptions/process', 'http'),
		);
	}	

	/**
	 * Validates a particular order. Sets $this->errors if it fails.
	 *
	 * @chainable
	 * @param   array  Array, usually from GET, of params to check
	 * @return  Order_Model  This object
	 */
	public function check($params)
	{
		$required = array('reference', 'etat', 'hmac', 'refsfp');
		foreach ($required as $req)
		{
			if (!isset($params[$req]))
			{
				return $this->error('invalid');
			}
		}
		
		// check the order state			
		switch ($params['etat'])
		{
			case 1: break;
			case 2: return $this->error('refused');
			case 99: if (IN_PRODUCTION) return $this->error('invalid');
				break;
			default: return $this->error('invalid');
		}

		$this->where('reference', $params['reference'])->find();

		if ( ! $this->loaded)
		{
			return $this->error('not_found');
		}
		
		if ($this->status != 'P')
		{
			return $this->error('not_pending');
		}
		
		// Certain parameters can be changed by the user 
		foreach ($this->spplus_params() as $param => $value)
		{
			if ( ! isset($params[$param]) || $params[$param] != urldecode($value))
			{
				// console::log("$param=$value instead of {$params[$param]}");
				return $this->error('invalid');	
			}
		}

		// check hmac validity
		if ( ! self::check_hmac($params, substr(Router::$query_string, 1), $_GET['hmac']))
		{
			return $this->error('invalid');	
		}
		
		// disabled
		// $this->validate_payment();

		// We made it!
		return $this;
 	}

	/**
	 * Calculate hmac from a query string
	 */
	public static function check_hmac($params, $query, $hmac)
	{
		$pos = strpos($query, '&hmac=');
		$string = $query;
		$string = substr($query, 0, $pos);
		$string .= substr($query, $pos + strlen($hmac) + 6, strlen($query));
		$query = "";

		// split string to get the parameters
		$tok = strtok($string, '=&');

		while ($tok)
		{
			if ($params[$tok])
			{
				$tok = strtok('&=');
				$query .= $tok;
			}
			$tok = strtok('&=');
			$tok = urldecode($tok);
		}
		
		// calculate the hmac hash
		$check_hmac = nthmac(Kohana::config('payment.spplus.clent'), $query);

        return strcmp($check_hmac, $hmac) == 0;
	}
 
 	/**
 	 * Process a successfully create order, by adding all the credits
 	 *
 	 * @chainable
 	 * @return  Order_Model  This object
 	 */
 	public function process()
 	{
 		for ($i = 0; $i < $this->credits; $i++) 
 		{
 			ORM::factory('credit')->create($this);
 		}

 		$this->status = 'C';
 		$this->process_date = date::reformat_datetime();
 		return $this->save();
 	}

	/**
	 * Trigger an error, which is stored in $this->errors
	 *
	 * @chainable
	 * @param   string  Error code, which is looked up in the subscriptions localization file
	 * @return  Order_Model  This object
	 */
	protected function error($msg)
	{
		// Mark order as in an error state
		$this->status = 'F';
		$this->save();
		
		$this->errors = Kohana::lang("account.order.$msg");
		return $this;
	}
	
	public function validate_payment()
	{
		// good: reference;idtftpaie;etatpaie;libetatpaie;payscarte;numautopaie;mode spp20081124033511;36628282;TERMINE;Termin黮ull;81290;auto idtftech;etatech;libetatech;numautoech;numremiseech 43620908;EN_ATTENTE_DE_REMISE;En attente de remise;81290; 
		// bad: reference;idtftpaie;etatpaie;libetatpaie;payscarte;numautopaie;mode spp20081124033156;36628268;REFUSE;Refus黮ull;;auto idtftech;etatech;libetatech;numautoech;numremiseech 43620889;REFUSE;Refus&eacute;e;; 
		// bad: anything else (spadminko)
		
		// build parameter array for spplus
		$params = array
		(
			'action' => 'etatpaiement',
			'siret' => Kohana::config('payment.spplus.siret_short'),
			'reference' => $this->reference,
		);

		console::log(implode($params)); 
		
		// we get the hmac
		$params['hmac'] = nthmac(Kohana::config('payment.spplus.clent'), implode($params));
		$params['siret'] = Kohana::config('payment.spplus.codesiret');

		console::log($params['hmac']);

		// calculate our call url		
		$url = Kohana::config('payment.spplus.servlet_url') . '?' . http_build_query($params);
	
		console::log($url);
		
		// call the spplus admin servlet
		$response = file_get_contents($url);
		
		// check the response
		console::log($response);
	}	

	/**
	 * Nice little hack to make deleting a order not actually delete
	 *
	 * @param   integer|null Id [optional]
	 * @return  ORM
	 */
	public function delete($id = NULL)
	{
		if ($id)
		{
			$this->find($id);
		}
		
		if ($this->loaded)
		{
			$credits = ORM::factory('credit')->where('order_id', $this->id)->find_all();
			foreach ($credits as $credit)
			{
				$credit->active = !$credit->active;
				$credit->save();
			}
		}
		
		return $this;
	}
	
	public function status()
	{
		$credit = ORM::factory('credit')->where('order_id', $this->id)->find();
		return $credit->loaded ? $credit->active : FALSE;
	}


} // End Order_Model