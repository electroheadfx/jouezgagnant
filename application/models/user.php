<?php

class User_Model extends ORM
{
	public $has_many = array('order', 'credit');
	
	/**
	 * @var   Session
	 */
	protected $session;

	/**
	 * Build a new user 
	 */
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		$this->session = Session::instance();
	}

	/**
	 * Load a user object from session
	 * @return  bool
	 */
	public function load_from_session()
	{
		return $this->where('active', TRUE)->find($this->session->get('user_id'));
	}
	
	/**
	 * Attempts to log a user in by matching his password against the db.
	 * @return  null|User User object or null if failure
	 */
	public static function auth_login($email, $cleartext)
	{
		// load this user info from the database
		$user = ORM::factory('user')->where('email', $email)->where('active', TRUE)->find();
		
		if (!$user->loaded)
		{
			return NULL;
		}
		
		$salt = cipher::find_salt($user->password);
		if (cipher::hash_password($cleartext, $salt) != $user->password)
		{
			return NULL;
		}

		$user->login();
		return $user;
	}
	
	/**
	 * Set session cookie and update activity
	 *
	 * @chainable
	 * @return  User_Model
	 */
	public function login()
	{
		$this->session->set('user_id', $this->id);
		return $this;
	}

	/**
	 * Log a user in from session key
	 *
	 * @return  bool      Success
	 */
	public static function auto_login()
	{
		if (!self::logged_in())
			return FALSE;

		$user = ORM::factory('user')->load_from_session();

		if (!$user->loaded)
		{
			self::logout();
			return FALSE;
		}
		
		return $user->login();
	}

	/**
	 * Are we logged in?
	 *
	 * @return  bool
	 */
	public static function logged_in()
	{
		return (Session::instance()->get('user_id') !== FALSE);
	}
	
	/**
	 * Log a user out
	 */
	public static function logout()
	{
		Session::instance()->delete('user_id');
	}
	
	/**
	 * Determines if an email already exists
	 *
	 * @param   string     Email
	 * @return  bool
	 */
	public static function email_exists($email)
	{
		return (bool) ORM::factory('user')->where('email', $email)->find()->count_last_query();
	}
	
	/**
	 * Nice little hack to make deleting a user not actually delete them
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
			$this->active = 0;
			$this->save();
		}
		
		return $this;
	}
	
	/**
	 * User level check -- is admin
	 *
	 * @return boolean
	 */
	public function is_admin()
	{
		return $this->user_level == 'admin';
	}
	
	/**
	 * Returns number of available credits
	 *
	 * @return  integer
	 */
	public function credits_available()
	{
		return ORM::factory('credit')
			->where('user_id', $this->id)
			->where('expiry_date >', date::reformat_datetime())
			->where('date_used', NULL)
			->where('active', TRUE)
			->find_all()
			->count();
	}

	/**
	 * Returns number of used credits
	 *
	 * @return  integer
	 */
	public function credits_spent()
	{
		return ORM::factory('credit')
			->where('user_id', $this->id)
			->where('date_used IS NOT', NULL)
			->where('active', TRUE)
			->find_all()
			->count();
	}
	
	/**
	 * Finds a free credit and consumes it, if one was found. Looks for credits in order of expiry.
	 * If no credit found, returns false.
	 *
	 * @return  boolean  True if we found a credit to use
	 */
	public function consume_credit()
	{
		if ($this->todays_credit()->loaded)
		{
			return FALSE;
		}
		
		$credit = ORM::factory('credit')->get_next($this->id);
			
		if ( ! $credit->loaded)
		{
			return FALSE;
		}
		else
		{
			$credit->consume();
			return TRUE;
		}
	}

	/**
	 * Determines if this user has purchased a credit today
	 *
	 * @return Credit_Model
	 */
	public function todays_credit()
	{
		return ORM::factory('credit')->today($this->id);
	}

} // End User_Model