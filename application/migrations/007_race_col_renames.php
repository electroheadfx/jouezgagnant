<?php

class Race_Col_Renames extends Migration {
	
	public function up()
	{
		$this->rename_column('races', 'pmu_meet_num', 'pmu');
		$this->rename_column('races', 'race_num', 'race');
		$this->rename_column('races', 'pick_1', 'first');
		$this->rename_column('races', 'pick_2', 'second');
		$this->rename_column('races', 'pick_3', 'third');
	}

	public function down()
	{
		$this->rename_column('races', 'pmu', 'pmu_meet_num');
		$this->rename_column('races', 'race', 'race_num');
		$this->rename_column('races', 'first', 'pick_1');
		$this->rename_column('races', 'second', 'pick_2');
		$this->rename_column('races', 'third', 'pick_3');
	}	
}