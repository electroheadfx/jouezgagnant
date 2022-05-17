<?php
class Fire_Profiler extends FirePHP{

	public static $kohana_instance;
	
	public static function getInstance()
	{
		return self::$kohana_instance;
	}
	
	public function __construct()
	{
	  	self::init();
	  	
	  	self::$kohana_instance = $this;

		// Add all built in profiles to event
		Event::add('fire-profiler.run', array($this, 'benchmarks'));
		Event::add('fire-profiler.run', array($this, 'database'));
		Event::add('fire-profiler.run', array($this, 'session'));
		Event::add('fire-profiler.run', array($this, 'post'));
		Event::add('fire-profiler.run', array($this, 'cookies'));
		Event::add('fire-profiler.run', array($this, 'files'));
		// Event::add('fire-profiler.run', array($this, 'objects'));
			  	
		// Add profiler to page output automatically
		Event::add('system.display', array($this, 'render'));
	}
	/**
	 * Disables the profiler for this page only.
	 * Best used when profiler is autoloaded.
	 *
	 * @return  void
	 */
	public function disable()
	{
		// Removes itself from the event queue
		Event::clear('system.display', array($this, 'render'));
	}
	/**
	 * Render the profiler. Output is added to FirePHP
	 *
	 * @param   boolean  return the output if TRUE
	 * @return  void|string
	 */
	public function render()
	{
		if ( ! IN_PRODUCTION)
		{
			Event::run('fire-profiler.run', $this);
		}
	}
	
	/**
	 * Benchmark times and memory usage from the Benchmark library.
	 *
	 * @return  void
	 */
	public function database()
	{
		$queries = Database::$benchmarks;

		$total_time = $total_rows = 0;
		$table = array();
		$table[] = array('SQL Statement','Time','Rows');
		
		foreach ($queries as $query)
		{
			$query['query'] = preg_replace('/[a-zA-Z0-9]{200,}/', '<something really fscking long>', $query['query']);

			$table[]=array(str_replace("\n",' ',$query['query']), number_format($query['time'], 3), $query['rows']);
			
			$total_time += $query['time'];
			$total_rows += $query['rows'];
		}

		$this->fb(array(count($queries).' SQL queries took '.number_format($total_time,3).' seconds and returned '.$total_rows.' rows',  $table
		  ),FirePHP::TABLE);
	}

	/**
	 * Database query benchmarks.
	 *
	 * @return  void
	 */
	public function benchmarks()
	{
		$benchmarks = Benchmark::get(TRUE);

		// Moves the first benchmark (total execution time) to the end of the array
		$benchmarks = array_slice($benchmarks, 1) + array_slice($benchmarks, 0, 1);
		
		$table = array();
		$table[] = array('Benchmark','Time','Memory');
		
		foreach ($benchmarks as $name => $benchmark)
		{
			// Clean unique id from system benchmark names
			$name = ucwords(str_replace(array('_', '-'), ' ', str_replace(SYSTEM_BENCHMARK.'_', '', $name)));

			$table[] = array($name, number_format($benchmark['time'], 3), number_format($benchmark['memory'] / 1024 / 1024, 2).'MB');
		}
		
		$this->fb(array(count($benchmarks).' benchmarks took '.number_format($benchmark['time'], 3).' seconds and used up '. number_format($benchmark['memory'] / 1024 / 1024, 2).'MB'.' memory',  $table
		  ),FirePHP::TABLE);
	}
	
	/**
	 * Session data.
	 *
	 * @return  void
	 */
	public function session()
	{
		Session::instance();
		
		$table = array();
		$table[] = array('Session','Value');
		
		foreach($_SESSION as $name => $value)
		{
			if (is_object($value))
			{
				$value = get_class($value).' [object]';
			}

			$table[] = array($name, $value);

		}

		$this->fb(array('Session: '.count($_SESSION).' session variables',  $table  ),FirePHP::TABLE);
	}
	
	/**
	 * Cookie data.
	 *
	 * @return  void
	 */
	public function cookies()
	{
		$table = array();
		$table[] = array('Cookies','Value');
			
		foreach($_COOKIE as $name => $value)
		{
			$table[] = array($name, $value);
		}
		$this->fb(array('Cookies: '.count($_COOKIE).' cookies',  $table  ),FirePHP::TABLE);
	}

	/**
	 * POST data.
	 *
	 * @return  void
	 */
	public function post()
	{
		$table = array();
		$table[] = array('POST','Value');
			
		foreach($_POST as $name => $value)
		{
			$table[] = array($name, $value);
		}
		$this->fb(array('Post: '.count($_POST).' POST variables',  $table  ),FirePHP::TABLE);
	}

	/**
	 * FILES data.
	 *
	 * @return  void
	 */
	public function files()
	{
		if (empty($_FILES)) return;
		
		$table = array();
		$table[] = array('FILES','Value');
			
		foreach($_FILES as $name => $value)
		{
			$table[] = array($name, $value);
		}
		$this->fb(array('Files: '.count($_FILES).' FILES variables',  $table  ),FirePHP::TABLE);
	}
	
	/**
	 * DB Objects
	 *
	 * @return  void
	 */
	public function objects()
	{
		$table = array();
		$table[] = array('Object', 'Count');
		foreach (ORM::$hits as $object => $count)
		{
			$table[] = array($object, $count);
		}
		$cnt = array_sum(ORM::$hits);
		
		$this->fb(array("Total of $cnt ORM objects created", $table), FirePHP::TABLE);
	}
}