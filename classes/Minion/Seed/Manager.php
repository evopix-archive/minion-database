<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * The seed manager is responsible for locating and executing seed classes.
 */
class Minion_Seed_Manager {

	/**
	 * The database connection that should be used
	 * @var Database
	 */
	protected $_db;

	/**
	 * Constructs the object, allows injection of a Database connection
	 *
	 * @param  Database  $db  The database connection that should be passed to seeds
	 */
	public function __construct(Database $db)
	{
		$this->_db = $db;
	}

	/**
	 * Set the database connection to be used
	 *
	 * @param  Database  $db  Database connection
	 * @return Minion_Seed_Manager
	 */
	public function set_db(Database $db)
	{
		$this->_db = $db;
		return $this;
	}

	public function run_seeds($groups = array())
	{
		if (empty($groups))
		{
			$groups = $this->fetch_seed_groups();
		}

		foreach ($groups as $group)
		{
			$seeder = $this->_get_seeder($group);
			$seeder->run();
		}
	}

	public function fetch_seed_groups()
	{
		$groups = [];
		$files = Kohana::list_files('database/seeds');
		foreach ($files as $file => $path)
		{
			$groups[] = substr($file, 15);
		}
		return $groups;
	}

	protected function _get_seeder($group)
	{
		$filename = 'DatabaseSeeder'.EXT;
		if ( ! ($file  = Kohana::find_file("database/seeds/$group", $filename, FALSE)))
		{
			throw new Kohana_Exception(
				'Cannot load database seeder for group :group',
				[':group' => $group]
			);
		}

		include_once $file;

		$class = ucfirst($group).'_DatabaseSeeder';
		return new $class($group, $this->_db);
	}

}
