<?php

class Subscriptions_Controller extends Website_Controller
{
	protected function build($title, $view)
	{
		parent::build('subscriptions', $title, $view);
		$this->_add_stylesheet('order');
	}
	
	public function index()
	{
		$this->build('jouezgagnant -- subscriptions', 'subscriptions/home');
		$this->template->page_id = "subscribe";
	}
	
	public function order()
	{
		if (empty($_GET['type']) || ! ($order_info = Kohana::config("payment.orders.{$_GET['type']}")))
		{
			$this->_user_message(Kohana::lang('invalid_type'));
			url::redirect_lang('/subscriptions');
		}
		
		$this->session->set('order_info', $order_info);
		url::redirect_lang('/subscriptions/agree');
	}
	
	public function agree()
	{
		if ( ! ($order_info = $this->session->get('order_info')))
		{
			$this->_user_message(Kohana::lang('verify_problem'));
			url::redirect_lang('/subscriptions');
		}

		$this->template->page_id = "agreement";
		$this->view->page_id = "agreement";
		$this->build('jouezgagnant -- subscription agreement', 'subscriptions/agree');
	}
	
	public function confirm()
	{
		$this->template->page_id = "confirm";
		$this->_add_stylesheet('account');
		if ( ! ($order_info = $this->session->get('order_info')))
		{
			$this->_user_message(Kohana::lang('verify_problem'));
			url::redirect_lang('/subscriptions');
		}
		
		$this->build('jouezgagnant -- confirm order', 'subscriptions/confirm');
		$this->view->order_info = $order_info;
	}
	
	public function send()
	{
		if ( ! ($order_info = $this->session->get('order_info')))
		{
			$this->_user_message(Kohana::lang('no_order'));
			url::redirect_lang('/subscriptions');
		}

		// Store new order
		$order = ORM::factory('order')->create($order_info);
		
		// store session
		$_SESSION['order_info']['reference'] = $order->reference;

		// redirect to spplus
		url::redirect($order->spplus_url());
	}
	
	public function process()
	{
		// for now just delete session
		$this->session->delete('order_info');

		$order = ORM::factory('order')->check($_GET);
		
		if ($order->errors)
		{
			$this->_user_message($order->errors);
			url::redirect('/subscriptions');
		}
		else
		{
			$this->_user_message(Kohana::lang('account.order.success'), TRUE);
			$order->process();
			url::redirect('/account');
		}
	}
	
	public function test()
	{
		if (IN_PRODUCTION) return;
		
		$order = ORM::factory('order')->where('reference', $_GET['id'])->find();
		if ($order->loaded) 
		{
			echo "testing admin servlet";
			$order->validate_payment();
		}
		else
		{
			echo "not found";
		}
	}
}