<?php

class Pages_Controller extends Website_Controller
{
	public function __call($method, $args)
	{
		if (!IN_PRODUCTION && isset($_GET['id']))
		{
			$page = ORM::factory('page')->find($_GET['id']);
		}
		else
		{
			$page = ORM::factory('page')
				->where('name', $method)
				->where('language', Kohana::config('locale.lang'))
				->where('active', TRUE)
				->find();
		}
		
		if (!$page->loaded)
		{
			Event::run('system.404');
		}
		
		$this->build('home', "jouezgagnant -- $page->title", 'pages/base');
		$this->view->page_content = $page->content;
		$this->view->page_name = $page->name;
	}
}