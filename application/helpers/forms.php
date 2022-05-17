<?php 

class forms_Core
{
	/**
	 * Validation rules for registration form
	 * @param   Validation
	 */
	protected static function user_create(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('email', 'required', 'email', 'user_email_free', 'length[5,50]');
		$valid->add_rules('first_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('last_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('address', 'required', 'length[4,50]');
		$valid->add_rules('address2', 'length[5,50]');
		$valid->add_rules('city', 'required', 'length[1,15]', 'standard_text');
		$valid->add_rules('postal_code', 'length[3,15]', 'alpha_numeric');
		$valid->add_rules('password', 'required', 'length[4,20]', 'alpha_numeric');
		$valid->add_rules('password_confirm', 'matches[password]');
		$valid->add_callbacks('birth_date', array('valid', 'assemble_date'));
		$valid->post_unset('password_confirm');
		$valid->post_filter(array('cipher', 'hash_password'), 'password');
	}

	protected static function user_edit(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('first_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('last_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('address', 'required', 'length[4,50]');
		$valid->add_rules('address2', 'length[5,50]');
		$valid->add_rules('city', 'required', 'length[1,15]', 'standard_text');
		$valid->add_rules('postal_code', 'length[3,15]', 'alpha_numeric');
		$valid->add_callbacks('birth_date', array('valid', 'assemble_date'));
	}
	
	/**
	 * Validation for login form
	 * @param   Validation
	 */
	protected static function user_login(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('email', 'required');
		$valid->add_rules('password', 'required');
	}
	
	/**
	 * Administration of a user
	 * @param Validation
	 */
	protected static function user_adminedit(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('email', 'required', 'email', 'user_admin_email_free', 'length[5,50]');
		$valid->add_rules('first_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('last_name', 'required', 'length[2,40]', 'standard_text');
		$valid->add_rules('address', 'required', 'length[4,50]');
		$valid->add_rules('address2', 'length[2,50]');
		$valid->add_rules('city', 'required', 'length[1,15]', 'standard_text');
		$valid->add_rules('postal_code', 'length[3,15]', 'alpha_numeric');
		$valid->add_rules('password', 'length[4,20]', 'alpha_numeric');
		if (isset($valid->password) && $valid->password)
		{
			$valid->post_filter(array('cipher', 'hash_password'), 'password');
		}
		else
		{
			$valid->post_unset('password');
		}
		$valid->add_rules('active', 'checkbox');
		$valid->post_filter(array('valid', 'boolify'), 'active');
		$valid->add_rules('birth_date', 'required');
		$valid->post_filter(array('date', 'reformat_datetime'), 'birth_date');
	}

	protected static function user_admincreate(Validation $valid)
	{
		self::user_adminedit($valid);
		$valid->add_rules('password', 'required');
	}

	/**
	 * Validation for page edit/create form
	 * @param   Validation
	 */
	protected static function page_adminedit(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('name', 'required', 'alpha_dash', 'length[4,40]');
		$valid->add_rules('title', 'required', 'standard_text', 'length[3,80]');
		$valid->add_rules('content', 'required');
		$valid->add_rules('language', 'required', 'language');
		$valid->add_rules('active', 'checkbox');
		$valid->post_filter(array('valid', 'boolify'), 'active');
	}
	
	protected static function page_admincreate(Validation $valid)
	{
		self::page_adminedit($valid);
	}

	/**
	 * Validation for race edit/create form
	 * @param Validation
	 */
	protected static function race_adminedit(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('date', 'required');
		$valid->add_rules('time', 'required');
		$valid->post_unset('time');
		$valid->add_callbacks('date', array('valid', 'combine_adjust_timezone'));
		$valid->add_rules('spot', 'required', 'standard_text', 'length[3,50]');
		$valid->add_rules('pmu', 'required', 'numeric');
		$valid->add_rules('race', 'required', 'numeric');
		$valid->add_rules('first', 'numeric');
		$valid->add_rules('second', 'numeric');
		$valid->add_rules('third', 'numeric');
		$valid->add_rules('featured', 'checkbox');
		$valid->post_filter(array('valid', 'boolify'), 'featured');
		$valid->add_rules('horse', 'numeric');
		$valid->add_rules('horse_odds', 'numeric');
	}
	
	protected static function race_admincreate(Validation $valid)
	{
		self::race_adminedit($valid);
	}
	
	/**
	 * Validation for race day edit/create form
	 * @param Validation
	 */
	protected static function race_day_adminedit(Validation $valid)
	{
		$valid->pre_filter('trim', true);
		$valid->add_rules('date', 'required');
		$valid->add_rules('day_open', 'required');
		$valid->add_rules('day_close', 'required');
		$valid->add_callbacks('day_open', array('valid', 'merge_to_datetime'));
		$valid->add_callbacks('day_close', array('valid', 'merge_to_datetime'));
		$valid->add_rules('jg_open', 'required');
		$valid->add_rules('jg_close', 'required');
		$valid->add_callbacks('jg_open', array('valid', 'merge_to_datetime'));
		$valid->add_callbacks('jg_close', array('valid', 'merge_to_datetime'));
		$valid->post_unset('date');
	}
	
	protected static function race_day_admincreate(Validation $valid)
	{
		self::race_day_adminedit($valid);
	}
	
	/**
	 * Validation for media forms
	 * @param Validation
	 */
	protected static function media_adminupload(Validation $valid)
	{
		$valid->add_rules('file', 'Media_Model::path_free');
		$valid->add_rules('file', 'upload::required', 'upload::valid', 'upload::type[gif,jpg,png,jpeg,css]', 'upload::size[1M]'); 
	}

	/**
	 * Build a validation object from a form name
	 *
	 * @param   string     Form name
	 * @param   array      Parameters (i.e., POST)
	 * @return  object     Validation object
	 */
	public static function build($form, $data = NULL)
	{
		$method = str_replace('.', '_', $form);
		if (!method_exists('forms', $method)) {
			throw new Kohana_Exception("Unable to validate '$method' : method not found");
		}
		
		$valid = $data ? new Validation($data) : new Validation(array());

		self::$method($valid);
		
		return $valid;
	}
	
	/**
	 * Export all javascript form validation to a file
	 *
	 * @param  string    File name
	 */
	public static function export_js($file_name)
	{
		console::log('Rebuilding jQuery validation cache');
		
		$methods = get_class_methods('forms');
		$file    = fopen($file_name, 'w');
		
		foreach ($methods as $method) 
		{
			if ($method == 'build' OR $method == 'export_js')
				continue;
				
			$valid = self::build($method);
			$js = $valid->jquery_validation($method);
			$js .= PHP_EOL;
			fwrite($file, $js);
		}

		fclose($file);
	}
}
