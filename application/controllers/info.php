<?php

class Info_Controller extends Website_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_add_stylesheet('info');
	}
	
	public function index()
	{
		$this->template->page_id = "info";
		$this->build('home', 'jouezgagnant', 'info/info');
	}
	
	public function jouez()
	{
		$this->template->page_id = "info";
		$this->build('home', 'jouezgagnant', 'info/jouez');
	}
	
	public function resultats1()
	{
		$this->template->page_id = "info";
		$this->build('home', 'jouezgagnant', 'info/resultats1');
	}
	public function resultats2()
	{
		$this->template->page_id = "info";
		$this->build('home', 'jouezgagnant', 'info/resultats2');
	}
	
}