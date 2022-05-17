<?php

class Database extends Database_Core
{
	public function platform()
	{
		return $this->config['connection']['type'];
	}
}