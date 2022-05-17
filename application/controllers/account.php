<?php

class Account_Controller extends Website_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->_add_stylesheet('account');
	}
	
	protected function build($title, $view)
	{
		parent::build('account', $title, $view);
	}
	
	public function index()
	{
		$orders = ORM::factory('order')
							->where(array('user_id' => $this->user->id))
							->orderby('date', 'desc')
							->limit(20)
							->find_all();
		
		$open_credits = ORM::factory('credit')
							->where(array('user_id'=> $this->user->id, 'date_used' => NULL, 'active' => 1))
							->orderby('expiry_date', 'asc')
							->limit(100)
							->find_all();
		
		$used_credits = ORM::factory('credit')
							->where(array('user_id'=> $this->user->id, 'date_used IS NOT' => NULL))
							->orderby('date_used', 'desc')
							->limit(20)
							->find_all();
		
		$this->build('jouezgagnant -- account', 'account/home');
		$this->view->user = $this->user;
		$this->view->orders = $orders;
		$this->view->open_credits = $open_credits;
		$this->view->used_credits = $used_credits;
		$this->view->tz = $this->user->timezone;
	}
	
	public function login()
	{
		if (!empty($this->user))
		{
			console::log('user is not empty.');
			url::redirect_lang('/account');
		}
		$this->template->page_id = "login";
		$this->build('jouezgagnant -- login', 'account/login');
		
		if ($user = $this->validate_post('user.login'))
		{
			if (User_Model::auth_login($user->email, $user->password))
			{
				$where = $this->session->get('redirect_flash');
				if (!$where) $where = '/account';
				url::redirect_lang($where);
			}
			else
			{
				$this->_user_message(Kohana::lang('bad_password'));
			}
		}
	}
	
	public function create()
	{
		$this->template->page_id = "create";
		$this->build('jouezgagnant -- create account', 'account/create');
		
		if ($user = $this->validate_post('user.create', TRUE))
		{
			$user->login();
			url::redirect_lang('/account');
		}
	}
	
	public function edit()
	{
		$this->template->page_id = "edit";
		$this->build('jouezgagnant -- edit account', 'account/edit');
		
		$this->view->edit = ORM::factory('user', $this->user->id);
		$this->view->months = array(
			'01'	=> 'Jan',
			'02'	=> 'Feb',
			'03'	=> 'Mar',
			'04'	=> 'Apr',
			'05'	=> 'May',
			'06'	=> 'Jun',
			'07'	=> 'Jul',
			'08'	=> 'Aug',
			'09'	=> 'Sep',
			'10'	=> 'Oct',
			'11'	=> 'Nov',
			'12'	=> 'dec'
		);
		
		if ($user = $this->validate_post('user.edit', TRUE, $this->user))
		{
			url::redirect_lang('/account');
		}
	}
	
	public function logout()
	{
		User_Model::logout();
		url::redirect_lang();
	}
}
