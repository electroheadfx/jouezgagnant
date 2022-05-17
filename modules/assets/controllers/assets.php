<?php defined('SYSPATH') or die('No direct script access.');
class Assets_Controller extends Controller
{
    public $use_cache = true;
    public $cache_lifetime = 0;

    /**
     * __construct
     *
     * @return void
     *
     */
    public function __construct()
    {
    	parent::__construct();
    	
        if (expires::check(172800) === false)
            expires::set(172800);

        if (Kohana::config('assets.cache') != true)
            $this->use_cache = false;

        $this->use_cache and $this->cache_lifetime = Kohana::config('assets.cache_lifetime');
    }

    /**
     * _remap was better
     *
     * @return mixed
     *
     */
    public function __call($method, $args = NULL)
    {
    	list ($file, $type) = preg_split('/\.(?=[^.]++$)/', $this->uri->string());

		switch($type)
		{
	    	case 'css':
	    	case 'js':
				try
				{
		    		$data = View::factory($file, null, $type)->render();
				}
				catch (Kohana_Exception $e)
				{
            	    try
                    {
                        $data = View::factory($file.'.'.$type)->render();
                    }
                    catch (Kohana_Exception $e)
		    		{
						Event::run('system.404');
		    		}
				}

                if (Kohana::config('assets.compress') === true)
                {
                    $method = 'compress_'.$type;
                    $data = $this->$method($data);
                }
	    break;
	    default:

	        $this->use_cache = false;

			if (Kohana::config('assets.prevent_hotlink') and isset($_SERVER['HTTP_REFERER']) and strpos($_SERVER['HTTP_REFERER'], url::base(true, true)) === false)
				return false;

			try
			{
		    	$data = View::factory($file, null, $type);
			}
			catch (Kohana_Exception $e)
			{
		    	Event::run('system.404');
			}
		
	    	break;
		}

		echo $data;
    }

    /**
     * compress_js
     *
     * @param string
     * @return string
     *
     */
    private function compress_js($data)
    {
        try
		{
	    	include Kohana::find_file('vendor', 'Jsmin');
            return JSMin::minify($data);
        }
		catch(JSMinException $e)
		{
            return $data;
        }
    }

    /**
     * compress_css
     *
     * @param string
     * @return string
     *
     */
    private function compress_css($data)
    {
		$data = preg_replace('~/\*[^*]*\*+([^/][^*]*\*+)*/~', '', $data);
		$data = preg_replace('~\s+~', ' ', $data);
		$data = preg_replace('~ *+([{}+>:;,]) *~', '$1', trim($data));
		$data = str_replace(';}', '}', $data);
		$data = preg_replace('~[^{}]++\{\}~', '', $data);
		return $data;
    }
    
} // End Assets_Controller