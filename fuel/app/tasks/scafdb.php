<?php
namespace Fuel\Tasks;

class Scafdb
{
	public static $ignore_fields = array(
		'id',
		'created_at',
		'updated_at',
	);

	public static $ignore_tables = array(
		'migration',
	);

	/**
	 * Do Nothing.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb
	 */
	public static function run()
	{
		exit('You must choose one method.'); //TODO:
	}

	/**
	 * Scaffold by database table.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:scaf $table
	 */
	public static function scaf($table='')
	{
		if(!strlen($table))
		{
			exit('Usage : php oil r scafdb:scaf $table');
		}

		$subfolder = 'orm'; //TODO:
		call_user_func(self::is_admin() ?
			'Oil\Generate_Admin::forge' : 'Oil\Generate_Scaffold::forge', self::mk_args($table), $subfolder);
	}

	/**
	 * Scaffold all database tables.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:scaf_all
	 */
	public static function scaf_all()
	{
		$tables = \DB::list_tables();
		foreach ($tables as $table)
		{
			if(in_array($table, self::$ignore_tables))
			{
				continue;
			}

			self::run($table);
		}
	}

	/**
	 * Scaffold model by database table.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:model $table
	 */
	public static function model($table='')
	{
		if(!strlen($table))
		{
			exit('Usage : php oil r scafdb:model $table');
		}

		call_user_func('Oil\Generate::model', self::mk_args($table));
	}

	/**
	 * Scaffold all models.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:model_all
	 */
	public static function model_all()
	{
		$tables = \DB::list_tables();
		foreach ($tables as $table)
		{
			if(in_array($table, self::$ignore_tables))
			{
				continue;
			}

			self::model($table);
		}
	}

	/*******************************************************
	 * Private Methods
	 ******************************************************/
	private static function mk_args($table)
	{
		$cols = \DB::list_columns($table);

		$args = array();
		foreach ($cols as $col)
		{
			if(in_array($col['name'], self::$ignore_fields))
			{
				continue;
			}

			$constraint = ''; //TODO:
			$args[] = $col['name'] . ':' . $col['data_type'] . $constraint;
		}

		array_unshift($args, $table);

		return $args;
	}

	private static function is_admin()
	{
		return \Cli::option('admin') || \Cli::option('a');
	}
}

/* End of file tasks/scafdb.php */
