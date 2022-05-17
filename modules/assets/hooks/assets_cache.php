<?php defined('SYSPATH') or die('No direct script access.');

class assets_cache
{
    protected $mime = '';
    
    /**
     * __construct
     *
     * @return void
     *
     */
    public function __construct()
    {
        Event::add_after('system.routing', array('Router', 'setup'), array($this, 'load_cache'));
        Event::add('system.send_headers', array($this, 'set_headers'));
    }

    /**
     * load_cache
     *
     * @return void
     *
     */
    public function load_cache()
    {
        if ($cache = Cache::instance()->get('assets-'.Router::$current_uri)) 
		{
            Event::has_run('system.send_headers') or Event::run('system.send_headers');

            Event::run('system.display', $cache);

            Kohana::render($cache);
            exit;
        }
		else 
		{
            Event::add('system.display', array($this, 'save_cache'));
        }
    }

    /**
     * save_cache
     *
     * @return void
     *
     */
    public function save_cache()
    {
        if (isset(Kohana::instance()->use_cache) and Kohana::instance()->use_cache === true) 
            Cache::instance()->set('assets-'.Router::$current_uri, Event::$data, null, Kohana::instance()->cache_lifetime);
    }
    
    /**
     * set_headers
     *
     * @return void
     *
     */
    public function set_headers()
    {
        @list($file, $this->mime) = preg_split('/\.(?=[^.]++$)/', Router::$current_uri);

        if ($this->mime !== '') 
	    	$mime = Kohana::config('mimes.'.$this->mime) and header("Content-type: ".$mime[0]."; charset=UTF-8");
    }

} //End Assets_Cache Hook
new assets_cache;