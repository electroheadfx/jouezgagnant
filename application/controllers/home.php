<?php

class Home_Controller extends Website_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_add_stylesheet('home');
	}
	
	public function index()
	{
		$races = ORM::factory('race')->where("`featured` = 1")->orderby('date', 'desc')->limit(2)->find_all();
		$race1 = $races[0];

		$race2_final = false;
		if ($races->count() > 1)
		{
			$race2 = $races[1];
			if (strtolower($race1->spot) === strtolower($race2->spot))
			{
				$d1 = date::reformat_short($race1->date);
				$d2 = date::reformat_short($race2->date);
				console::log($d1 . ' vs ' . $d2);
				if ($d1 === $d2)
				{
					$race2_final = $race2;
				}
			}
		}

		$today = date('Y-m-d');
		$active_races = ORM::factory('race')->where("date(`date`) = '$today'")->orderby('date', 'asc')->find_all();
		$race_list = array();
		foreach ($active_races as $race) {
			$race_list[] = $race->race;
		}
		if ($active_races->count() > 0)
		{
			$spot = $active_races[0];
			$spot = $spot->spot;
		} else {
			$spot = 'TBD';
		}

		$todays_race = ORM::factory('race_day')->where("date(`day_open`) = '$today'")->find();
		console::log($todays_race);

		$this->template->page_id = "home";
		$this->build('home', 'jouezgagnant', 'home');
		if (is_object($this->user)) {
			$this->view->tz = $this->user->timezone;
		} else {
			$this->view->tz = Kohana::config('locale.timezone');
		}
		$this->view->race_day = $todays_race;
		$this->view->spot = $spot;
		$this->view->active_races = $race_list;
		$this->view->race1 = $race1;
		$this->view->race2 = $race2_final;
	}

	public function results()
	{
		$races = ORM::factory('race')
							->where("`featured` = 1")
							->orderby('date', 'desc')
							->limit(30)
							->find_all();

		$this->template->page_id = "results";
		$this->build('home', 'jouezgagnant', 'results');
		if (is_object($this->user)) {
			$this->view->tz = $this->user->timezone;
		} else {
			$this->view->tz = Kohana::config('locale.timezone');
		}
		$this->view->races = $races;
	}

	public function entry()
	{
		$this->template->page_id = "entry";
		$this->build('home', 'jouezgagnant', 'entry');
		
	}
	
}