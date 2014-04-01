<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Displays the current status of migrations in all groups
 *
 * This task takes no config options
 *
 * @author Matt Button <matthew@sigswitch.com>
 */
class Task_Db_Status extends Minion_Task {

	/**
	 * Execute the task
	 *
	 * @param array $options Config for the task
	 */
	protected function _execute(array $options)
	{
		$model = new Model_Minion_Migration(Database::instance());
		$view  = new View('minion/task/db/status');

		$view->groups = $model->get_group_statuses();

		echo $view;
	}

}
