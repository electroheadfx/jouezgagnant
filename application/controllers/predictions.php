<?php

class Predictions_Controller extends Website_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_add_stylesheet('predictions');
	}
	
	public function build($title, $view)
	{
		parent::build('predictions', $title, $view);
		$this->template->page_id = "predict";
		$this->view->page_id = "predict";
	}
	
	public function index()
	{

		$active = false;
		$today = date('Y-m-d');
		$race_list = ORM::factory('race')->where("date(`date`) = '$today'")->orderby('date', 'asc')->find_all();
		
		if ($race_list->count() < 1)
		{
			$this->_user_message(Kohana::lang('predictions.no_races'));
			url::redirect_lang('/account');
		}
		
		$last = (count($race_list) - 1);
		$race_day = ORM::factory('race_day')->where("date(`jg_open`) = '$today'")->limit(1)->find();
		if (count($race_day) > 0)
		{
			$open = strtotime($race_day->jg_open);
			$close = strtotime($race_day->jg_close);
		}
		else
		{
			$open = strtotime($race_list[0]->date) - (60 * 60);
			$close = strtotime($race_list[$last]->date) + (60 * 60);
		}
		
		console::log("open: {$open} || close: {$close}");
		
		$now = time();
		if ($open < $now && $now < $close)
		{
			/* inside opening times for todays races, which should we display? */
			
			/* are we after the last race of the day? if so, display it */
			$last_time = strtotime($race_list[$last]->date);
			if ($now > $last_time) {
				$active = $race_list[$last];
				console::log("activating race: " . $race_list[$last]->race);
			} else {
				$active = $race_list[0];
				foreach ($race_list as $race) {
					$r = strtotime($race->date);
					if ($r >= $now) {
						if (($r - $now) <= (60 * 20)) {
							$active = $race;
							console::log("activating race: " . $race->race);
						}
					} else {
						$active = $race;
						console::log("activating race: " . $race->race);
					}
				}
			}
		} else {
			/* outside of the opening time for today's races */
			$this->_user_message(Kohana::lang('predictions.no_races'));
			url::redirect_lang('/account');
		}
		
		if (!$this->user->is_admin()) {
			$today = $this->user->todays_credit();
			if ($today->loaded === false) {
				$user_credits = $this->user->credits_available();
				if ($user_credits < 1) {
					$this->_user_message(Kohana::lang('predictions.no_credits'));
					url::redirect_lang('/account');
				}
				url::redirect_lang('/predictions/confirm');
			}
		}
		
		$this->build('jouezgagnant -- predictions', 'predictions/home');
		$this->view->race_list = $race_list;
		$this->view->active = $active;
	}
	
	public function confirm()
	{
		// decrement credit (check if spent again first to avoid double-charging)
		// redirect to predictions page
		$this->build('jouezgagnant -- predictions', 'predictions/confirm');
	}
	
	public function charge()
	{
		$today = $this->user->todays_credit();
		if ($today->loaded === false) {
			$user_credits = $this->user->credits_available();
			if ($user_credits < 1) {
				$this->_user_message(Kohana::lang('predictions.no_credits'));
				url::redirect_lang('/account');
			}
			$this->user->consume_credit();
			$this->_user_message(Kohana::lang('predictions.credit_used'));
			url::redirect_lang('/predictions');
		}
		url::redirect_lang('/predictions');
	}
	
}