<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * The Seed task seeds the database with data.
 */
class Task_Db_Seed extends Minion_Task {

	/**
	 * A set of config options that this task accepts
	 * @var array
	 */
	protected $_options = array(
		'group'   => NULL,
		'db'      => NULL,
	);

	/**
	 * Seeds the database
	 *
	 * @param array $options Configuration to use
	 */
	protected function _execute(array $options)
	{
		$groups  = $options['group'];
		$db_conn = $options['db'];

		$groups = $this->_parse_groups($groups);
		$db     = Database::instance($db_conn);
		$seed_manager = new Minion_Seed_Manager($db);
		$seed_manager->run_seeds($groups);
	}

	/**
	 * Parses a comma delimited set of groups and returns an array of them
	 *
	 * @param  string $group Comma delimited string of groups
	 * @return array         Locations
	 */
	protected function _parse_groups($group)
	{
		if (is_array($group))
			return $group;

		$group = trim($group);
		if (empty($group))
		{
			return [];
		}

		$groups = array();
		$group  = explode(',', trim($group, ','));

		if ( ! empty($group))
		{
			foreach ($group as $a_group)
			{
				$groups[] = trim($a_group, '/');
			}
		}

		return $groups;
	}

}
