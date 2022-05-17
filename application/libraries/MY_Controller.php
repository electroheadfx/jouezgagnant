<?php

class Controller extends Controller_Core {
	
	/**
	 * Session link
	 * @var Session
	 */
	protected $session;

	/**
	 * Database link
	 * @var Database
	 */
	protected $db;

	// Get and post as objects
	public $GET;
	public $POST;

	public function __construct()
	{
		parent::__construct();

		// Init the session and db connection
		$this->db       = Database::instance();
		$this->session  = Session::instance();

		// Init get and post
		$this->GET  = (object) $_GET;
		$this->POST = (object) $_POST;
	}
	
}