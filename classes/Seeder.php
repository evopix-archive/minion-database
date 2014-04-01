<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Seeder {

	/**
	 * Group name
	 *
	 * @var string
	 */
	protected $_group;

	/**
	 * @var Database
	 */
	protected $_db;

	public function __construct($group, Database $db)
	{
		$this->_group = $group;
		$this->_db    = $db;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {}

	/**
	 * Seed the given connection from the given path.
	 *
	 * @param string $class
	 * @return void
	 */
	public function call($class)
	{
		$this->_resolve($class)->run();
		Minion_CLI::write("Seeded: {$this->_group}/$class");
	}

	protected function _resolve($class)
	{
		$group = $this->_group;
		$filename = $class.EXT;
		if ( ! ($file  = Kohana::find_file("database/seeds/$group", $filename, FALSE)))
		{
			throw new Kohana_Exception(
				'Cannot load database seeder :seeder',
				[
					':seeder' => $class
				]
			);
		}

		$class = ucfirst($group).'_'.$class;
		include_once $file;
		return new $class($group, $this->_db);
	}

} // End Seeder