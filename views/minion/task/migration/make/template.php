
<?php if ( ! empty($description)): ?>
/**
 * <?php echo $description.PHP_EOL; ?>
 */
<?php endif; ?>
class <?php echo $class; ?> extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param  Database  $db  Database connection
	 */
	public function up(Database $db)
	{
<?php if ( ! empty($up)): ?>
<?php echo $up; ?>

<?php else: ?>
		Schema::create('...', function($table)
		{
			/* @var $table Schema_Blueprint */
		});
<?php endif; ?>
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param  Database  $db  Database connection
	 */
	public function down(Database $db)
	{
<?php if ( ! empty($down)): ?>
<?php echo $down; ?>

<?php else: ?>
		Schema::drop('...');
<?php endif; ?>
	}

}