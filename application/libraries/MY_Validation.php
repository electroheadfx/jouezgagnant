<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Validation class extended to handle jquery validation
 */
class Validation extends Validation_Core
{
	/**
	 * This variable holds the array of jquery rules
	 * @var  array
	 */
	protected $jquery = array();
	
	/**
	 * List of array keys to unset after validation
	 * @var  array
	 */
	public $post_unsets = array();
	
	/**
	 * Builds the validation and returns it as a string
	 *
	 * @param   string    Name of the form we are building it for
	 * @return  string    Raw javascript
	 */
	public function jquery_validation($form_name)
	{
		$this->build_jquery_validation($form_name);
		return $this->jquery_validation_string($form_name);
	}
	
	/**
	 * Converts a validation object into an array of jquery rules and messages
	 *
	 * @param   string    Name of the form we're building.
	 */
	public function build_jquery_validation($form_name)
	{
		$form_name = explode('.', $form_name);
		$form_name = $form_name[0];
		
		foreach ($this->rules as $field => $calls) {

			$rules = array();
			$messages = array();
				
			foreach ($calls as $call) {
				list($func, $args) = $call;
				
				// built in functions
				if (is_array($func) && $func[0] === $this) {

					switch ($func[1]) {
						case 'required':
							$rules['required'] = true;
							$messages['required'] = Kohana::lang("form.$form_name.$field.$func[1]");
							break;
						case 'length':
							$rules['minlength'] = $args[0];
							$rules['maxlength'] = $args[1];
							break;
						case 'matches':
							$rules['equalTo'] = '#'.$args[0];
							$messages['equalTo'] = Kohana::lang("form.$form_name.$field.$func[1]");
							break;
							
						default: break;
					}

				// standard validation functions
				} else if (is_array($func) && $func[0] === 'valid') {

					switch ($func[1]) {
						case 'email':
							$rules['email'] = true;
							break;
						case 'user_email_free':
							$rules['remote'] = '/ajax/email';
							$messages['remote'] = Kohana::lang("form.$form_name.$field.$func[1]");
							break;
						case 'user_name_changeable':
							$rules['remote'] = '/ajax/name_change';
							$messages['remote'] = Kohana::lang("form.$form_name.$field.$func[1]");
							break;

						default: break;
					}
					
				}
				
			}
			
			$this->jquery['rules'][$field] = $rules;
			$this->jquery['messages'][$field] = $messages;
		}
	}
	
	/**
	 * Converts the validation array to a javascript string
	 * @return string
	 */
	public function jquery_validation_string($form_name = NULL)
	{
		if (!$this->jquery)
			return "";
			
		$form_name = $form_name ? ( '#' . str_replace('.', '_', $form_name) . '_form' ) : 'form';
		
		return "$(function(){ $('$form_name').validate(" . json_encode($this->jquery) . ")});";
	}
	
	/**
	 * Unset a parameter after the validation has been passed
	 * @param   string   Parameter name
	 */
	public function post_unset($parameter)
	{
		$this->post_unsets[] = $parameter;
	}
	
	/**
	 * Normal validation plus post unsets
	 * @return bool
	 */
	public function validate()
	{
		$success = parent::validate();
		
		// unset the unneeded variables
		foreach ((array) $this->post_unsets as $key) {
			unset($this->$key);
			unset($this->rules[$key]);
		}

		return $success;
	}
}
