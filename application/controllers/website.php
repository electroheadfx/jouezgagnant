<?php

class Website_Controller extends Controller
{
	// Main site view
	public $template = 'jouezgagnant';
	
	// Special messages
	public $user_messages;
	public $user_message_success = FALSE;

	// Javascript variables
	protected $js_vars;
	
	// Raw javascript
	protected $js;
	
	// CSS Stylesheets
	protected $stylesheets;
	
	// JS Scripts
	protected $scripts;

	/**
	 * Build the template with a few parameters
	 *
	 * @param   string   Selected menu item
	 * @param   string   Title of the web page
	 * @param   string   Name of the view template
	 */
	protected function build($menusel, $title, $content_template)
	{
		// Render the template immediately after the controller method
		Event::add('system.post_controller', array($this, '_render'));
		
		$lang = Kohana::config('locale.language');
		$this->template->lang = substr($lang[0], 0, 2);

		$st_var = 'st_'.$menusel;
		$this->template->$st_var       = ' class="menuon"';
		$this->template->page_title    = $title;
		$this->template->page_content  = new View($content_template);
		$this->view = $this->template->page_content;
		
		return $this->view;
	}
	
	/**
	 * Combination of a template controller and some default values passed to the template
	 */
	public function __construct()
	{
		parent::__construct();

		// Check to see if the request is a HXR call
		if (request::is_ajax())
		{
			// Send the 403 header
			header('HTTP/1.1 403 Forbidden');
			return;
		}

		// Initialize template view
		$this->template = new View($this->template);
		$this->template->set_global('POST', $this->POST);
		$this->template->set_global('GET',  $this->GET);
		
		// Login, if we can
		$this->user = User_Model::auto_login();
		$this->template->set_global('user', $this->user);
		
		// copy over user messages from the last redirected page
		$this->user_messages = $this->session->get_once('user_messages');
		$this->user_message_success = $this->session->get_once('user_message_success');
		
		if (Kohana::config('site.javascript'))
		{
			// build javascript cache
			// $this->cache_jquery_validation();
			
			// Initialize js / css asset controller
			// $css = Kohana::config('assets.css');
			// $js = Kohana::config('assets.js');
			
			// $this->template->script     = assets::script($js);
			// $this->template->stylesheet = assets::stylesheet($css);
		}
		
		// Add some default styles
		$this->_add_stylesheet('jg');
		$this->_add_script('jquery');
		$this->_add_script('jg');
		$this->_add_script('jquery.populate');
		
		// Check access
		$this->check_access();
		
		// Set javascript base URL
		$base_url = rtrim(url::site('/'),'/');
		$this->_add_js_queue("jg.setBaseURL('$base_url/');");
	}
	
	/**
	 * Render the loaded template.
	 */
	public function _render()
	{
		// Pass over javascript and messages to the view
		$this->template->js_vars     = $this->js_vars;
		$this->template->js_queue    = $this->js_queue;
		$this->template->js          = $this->js;
		$this->template->messages    = $this->user_messages;
		$this->template->success_msg = $this->user_message_success;
		$this->template->stylesheets = $this->stylesheets;
		$this->template->scripts     = $this->scripts;
		
		// Render the template when the class is destroyed
		$this->template->render(TRUE);
	}
	
	/**
	 * Add raw javascript to the page
	 *
	 * @param   string   Raw javascript
	 */
	public function _add_js($code)
	{
		$this->js .= $code;
	}

	/**
	 * Add a javascript variable
	 *
	 * @param   string   Name of the variable
	 * @param   mixed    Value
	 */
	public function _add_js_var($name, $value)
	{
		$this->js_vars[$name] = $value;
	}

	/**
	 * Add a javascript function to document.ready
	 *
	 * @param   string   function call to be queued
	 */
	public function _add_js_queue($call)
	{
		$this->js_queue[] = $call;
	}

	/**
	 * Add a javascript file
	 *
	 * @param   string   Name of the file
	 */
	public function _add_script($script)
	{
		$this->scripts[] = $script;
	}
	
	/**
	 * Builds an array of text messages to be displayed at the top of the screen
	 *
	 * @param   array  String or array of messages
	 * @param   boolean Are these error messages or success messages?
	 */
	public function _user_message($msgs, $success = FALSE)
	{
		if ($msgs)
		{
			$this->user_messages = $this->user_messages ? array_merge((array) $this->user_messages, (array) $msgs) : $msgs;
			$this->user_message_success = $success;
		}
	}

	/**
	 * Add a css stylesheet
	 * @param   string  Name of the stylesheet
	 */
	public function _add_stylesheet($stylesheet)
	{
		$this->stylesheets[] = $stylesheet;
	}

	/**
	 * Add the jquery validation source directly to raw script
	 *
	 * @param   string     Form name
	 */
	protected function add_form_js($form)
	{
		// add the jquery validation for the form
		if (Kohana::config('site.javascript') AND Kohana::config('site.jquery_validation'))
		{
			$valid = forms::build($form);
			$jquery = $valid->jquery_validation($form);
			$this->add_js($jquery);
		}
	}
	
	private function cache_jquery_validation()
	{
		$form_file  = APPPATH.'helpers/forms.php';
		$cache_file = APPPATH.'views/assets/jquery.validate.cache.js.php';
		
		if (!file_exists($form_file))
		{
			throw new Kohana_Exception('jQuery validation cache: form file missing/renamed');
		}

		if (!file_exists($cache_file) OR (filemtime($form_file) > filemtime($cache_file)))
		{
			forms::export_js($cache_file);
		}
	}
	
	/**
	 * Validation helper. Will post error messages if they are generated.
	 *
	 * @param   string  name of the class.form
	 * @param   bool|string TRUE if we want to save on validation, or a string to redirect to a url (optional)
	 * @return  ORM  New object, or FALSE if we have errors
	 */
	protected function validate_post($form, $save = FALSE, $obj = NULL)
	{
		if (!$_POST) return FALSE;
		
		if (strstr($form, '.') === FALSE)
		{
			throw new Kohana_Exception('Bad parameters to validate_post');
		}
		
		$this->_add_js('$(function(){$("#'.str_replace('.', '_', $form.'_form').'").populate('.json_encode($_POST).');});');

		list($class, $method) = explode('.', $form);

		$valid = forms::build($form, $_POST);
		$class = $obj ? $obj : ORM::factory($class);
		if (!$class->validate($valid, $save))
		{
			$errs = $valid->errors("$class->object_name.$method");
			$this->_user_message($errs);
			return FALSE;
		}
		
		return $class;
	}
	
	protected function validate_files($form, $url = FALSE)
	{
		if (!$_FILES) return FALSE;
		
		if (strstr($form, '.') === FALSE)
		{
			throw new Kohana_Exception('Bad parameters to validate_files');
		}
		
		list($class, $method) = explode('.', $form);
		$class = ORM::factory($class);
		$valid = forms::build($form, $_FILES);
		if (!$valid->validate())
		{
			$errs = $valid->errors("$class->object_name.$method");
			$this->_user_message($errs);
			return FALSE;
		}
		else 
		{
			$class->file_upload($method);
			if ($url) url::redirect($url);
		}
	}
	
	/**
	 * Redirects the user to login, if we need to
	 */
	private function check_access()
	{
		$route = URI::$controller.'/'.URI::$method;

		if (text::in_regex_array($route, Kohana::config('access_control.li_pages')))
		{
			if (!User_Model::logged_in())
			{
				$this->session->set('redirect_flash', url::current(TRUE));
				$this->_user_message(Kohana::lang('base.logged_in'));
				url::redirect_lang('/account/login');
			}
		}
		else if (!text::in_regex_array($route, Kohana::config('access_control.nli_pages')))
		{
			if ( ! IN_PRODUCTION)
			{
				echo "Page $route not in access control, displaying in test site";
			}
			else
			{
				Event::run('system.404');
			}
		}
	}
}
