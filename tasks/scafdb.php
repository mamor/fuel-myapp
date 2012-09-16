<?php
namespace Fuel\Tasks;

/**
 * Generate scaffold or model for database tables.
 *
 * @author     Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright  2012 Mamoru Otsuka
 * @license    WTFPL http://sam.zoy.org/wtfpl/COPYING
 */
class Scafdb
{
	private static $ignore_fields = array(
		'id',
		'created_at',
		'updated_at',
	);

	private static $ignore_tables = array(
		'migration',
	);

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb
	 */
	public static function run()
	{
		self::help();
	}

	/**
	 * Generate scaffold for a database table.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:scaf $table
	 */
	public static function scaf($table = '')
	{
		if ( ! strlen($table))
		{
			exit('Usage : php oil r scafdb:scaf $table');
		}

		$subfolder = 'orm'; //TODO:
		call_user_func(self::is_admin() ?
			'Oil\Generate_Admin::forge' : 'Oil\Generate_Scaffold::forge', self::mk_args($table), $subfolder);
	}

	/**
	 * Generate scaffold for all database tables.
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
			if (in_array($table, self::$ignore_tables))
			{
				continue;
			}

			self::scaf($table);
		}
	}

	/**
	 * Generate model for a database table.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:model $table
	 */
	public static function model($table = '')
	{
		if ( ! strlen($table))
		{
			exit('Usage : php oil r scafdb:model $table');
		}

		call_user_func('Oil\Generate::model', self::mk_args($table));
	}

	/**
	 * Generate model for all database tables.
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
			if (in_array($table, self::$ignore_tables))
			{
				continue;
			}

			self::model($table);
		}
	}

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scafdb:help
	 */
	public static function help()
	{
		$output = <<<HELP

Description:
  Generate scaffold or model for exists database tables.
  Database settings must be configured.

Runtime options:
  -f, [--force]    # Overwrite files that already exist
  -a, [--admin]    # Generate admin

Commands:
  php oil r scafdb:scaf <table_name>
  php oil r scafdb:scaf_all
  php oil r scafdb:model <table_name>
  php oil r scafdb:model_all
  php oil r scafdb:help

HELP;
		\Cli::write($output);
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
			if (in_array($col['name'], self::$ignore_fields))
			{
				continue;
			}

			$constraint = ''; //TODO:
			$args[] = $col['name'].':'.$col['data_type'].$constraint;
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
