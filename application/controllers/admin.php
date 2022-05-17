<?php

class Admin_Controller extends Website_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->user || !$this->user->is_admin()) 
		{
			Event::run('system.404');
		}
		
		setlocale(LC_NUMERIC, 'en_US');
		console::log(localeconv());
		$this->_add_stylesheet('admin');
		$this->_add_script('jquery-ui');
		$lang = Kohana::config('locale.language');
		if ($lang[0] === 'fr_FR') {
			$this->_add_script('ui/i18n/ui.datepicker-fr');
		}
	}

	protected function build($title, $view)
	{
		parent::build('admin', $title, $view);
		$this->template->page_id = "admin";
		$this->view->page_id = "admin";
		$l = Kohana::config('locale.language');
		$this->view->lang = substr($l[0], 0, 2);
	}

	private function back_link($table)
	{
		$limit = $this->session->get("admin_limit_$table", 10);
		$page = $this->session->get("admin_page_$table");

		// Special case for date sorting
		if ($table == 'races' && $page)
		{
			$date = date::reformat('Y-m-d', $page);
			return url::site('/admin/races') . ($date ? "/view/$date" : '');
		}

		return url::site("/admin/$table") . ($page > 1 ? "/view/$page/$limit" : '');
	}

	private function build_pagination($table)
	{
		$limit = $this->session->get("admin_limit_$table", 10);
		$obj_name = inflector::singular($table);
		
		return Pagination::factory
		(
			array
			(
				'style' => 'windowed',
				'items_per_page' => $limit,
				'base_url' => url::site("/admin/$table/view"),
				'uri_segment' => 'view',
				'total_items' => ORM::factory($obj_name)->count_all(),
			)
		);			
	}

	private function load_objects($table)
	{
		$method = "load_$table";
		if (method_exists($this, $method))
		{
			$this->view->$table = $this->$method();
		}
		else
		{
			$limit = $this->session->get("admin_limit_$table", 10);
			$page = $this->session->get("admin_page_$table", 1);
			$offset = ($page - 1) * $limit;
			$obj_name = inflector::singular($table);
	
			$this->view->pagination = $this->build_pagination($table);
			$this->view->$table = ORM::factory($obj_name)->find_all($limit, $offset);
		}

		$this->view->back_link = $this->back_link($table);
	}

	/**
	 * Since races are filtered by date, they need a custom handler
	 */
	private function load_races()
	{
		$date = $this->session->get('admin_page_races');
		$races = ORM::factory('race');
		
		if ($date)
		{
			$date = date::reformat('Y-m-d', $date);
			$races->where("date(`date`) = '$date'");
		}
		$races->orderby('date', 'desc');
		
		return $races->find_all(40);
	}
	
	private function load_race_days()
	{
		$date = $this->session->get('admin_page_race_days');
		$race_days = ORM::factory('race_day');
		
		$race_days->orderby('jg_open', 'desc');
		if ($date)
		{
			$date = date::reformat('Y-m-d', $date);
			$race_days->where("date(`jg_open`) = '$date'");
			return $race_days->find_all();
		}
		else
		{
			return $race_days->find_all(20);
		}
	}
		
	public function index()
	{
		$this->build('jouezgagnant -- admin', 'admin/home');
	}
	
	public function __call($table, $args)
	{
		$tables = array
		(
			'orders' => 'order data',
			'pages' => 'static page content',
			'races' => 'race data',
			'race_days' => 'race day data',
			'media' => 'media',
			'users' => 'account data'
		);

		list($method, $arg1, $arg2) = array_merge($args ? $args : array('view'), array_fill(0, 2, NULL));

		// Check that we're viewing a valid page with a correct action
		if ( ! isset($tables[$table]) || ! method_exists($this, $method)) 
		{
			Event::run('system.404');
		}

		$this->build("jouezgagnant -- admin: {$tables[$table]}", "admin/$table");
		$this->view->method = $method;
		$this->view->tz = $this->user->timezone;
		
		// Invoke the method
		$this->$method($table, $arg1, $arg2);
	}
	
	private function view($table, $page = NULL, $limit = NULL)
	{
		$this->session->set("admin_page_$table", $page);
		$this->session->set("admin_limit_$table", $limit);

		$this->load_objects($table);
	}
	
	private function create($table)
	{
		$this->load_objects($table); 

		$obj_name = inflector::singular($table);
		$obj = $this->validate_post("$obj_name.admincreate", $this->back_link($table));
		$this->validate_files("$obj_name.adminupload", $this->back_link($table));
		$this->_add_js_queue("jg.admin.$table.create();");
	}

	private function delete($table, $id)
	{
		$this->load_objects($table);

		ORM::factory(inflector::singular($table))->delete($id);
		url::redirect($this->back_link($table));
	}
	
	private function edit($table, $id)
	{
		$this->load_objects($table);

		$this->_add_js_queue("jg.admin.$table.edit();");
		$obj_name = inflector::singular($table);
		$this->_add_js_var("current_$obj_name", $id);
		$obj = $this->view->edit = ORM::factory($obj_name, $id);
		$this->validate_post("$obj_name.adminedit", $this->back_link($table), $obj);
	}

}
