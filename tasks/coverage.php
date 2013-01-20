<?php
namespace Fuel\Tasks;

/**
 * Generate Code Coverage Report.
 *
 * @author     Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright  2013 Mamoru Otsuka
 * @license    WTFPL http://sam.zoy.org/wtfpl/COPYING
 */
class Coverage
{
	const DEFAULT_DIR = '../coverage/';
	const DEFAULT_GROUP = 'App';

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage
	 */
	public static function run()
	{
		static::help();
	}

	/**
	 * Generate Code Coverage Report for html.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:html [dir [group ]
	 */
	public static function html($dir = null, $group = self::DEFAULT_GROUP)
	{
		$type = $file = 'html';
		$path = $dir ? rtrim($dir, DS).DS.$file : static::DEFAULT_DIR.$file;

		static::check_path($path);
		static::generate($group, $type, $path);
	}

	/**
	 * Generate Code Coverage Report for clover.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:clover [dir [group ]
	 */
	public static function clover($dir = null, $group = self::DEFAULT_GROUP)
	{
		$type = 'clover';
		$file = 'coverage.xml';
		$path = $dir ? rtrim($dir, DS).DS.$file : static::DEFAULT_DIR.$file;

		static::check_path($path);
		static::generate($group, $type, $path);
	}

	/**
	 * Generate Code Coverage Report for text.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:text [dir [group ]
	 */
	public static function text($dir = null, $group = self::DEFAULT_GROUP)
	{
		$type = 'text';
		$file = 'coverage.text';
		$path = $dir ? rtrim($dir, DS).DS.$file : static::DEFAULT_DIR.$file;

		static::check_path($path);
		static::generate($group, $type, $path);
	}

	/**
	 * Generate Code Coverage Report for php.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:php [dir [group ]
	 */
	public static function php($dir = null, $group = self::DEFAULT_GROUP)
	{
		$type = 'php';
		$file = 'coverage.php';
		$path = $dir ? rtrim($dir, DS).DS.$file : static::DEFAULT_DIR.$file;

		static::check_path($path);
		static::generate($group, $type, $path);
	}

	/**
	 * Generate Code Coverage Report for all types.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:all [dir [group ]
	 */
	public static function all($dir = null, $group = self::DEFAULT_GROUP)
	{
		static::html($dir, $group);
		static::clover($dir, $group);
		static::text($dir, $group);
		static::php($dir, $group);
	}

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:help
	 */
	public static function help()
	{
		$output = <<<HELP

Description:
  Generate Code Coverage Report.

Runtime options:
  -f, [--force]    # Force delete and generate Coverage Report that already exist

Commands:
  php oil r coverage:html [dir [group ]
  php oil r coverage:clover [dir [group ]
  php oil r coverage:text [dir [group ]
  php oil r coverage:php [dir [group ]
  php oil r coverage:all [dir [group ]
  php oil r coverage:help

HELP;
		\Cli::write($output);
	}

	/*******************************************************
	 * Private Methods
	 ******************************************************/
	private static function check_path($path)
	{
		if (file_exists($path))
		{
			if ( ! \Cli::option('f') and ! \Cli::option('force'))
			{
				throw new \Exception(realpath($path).' already exist, please use -f option to force delete and generate.');
			}

			if ( ! static::delete_path($path))
			{
				throw new \Exception('Could not delete '.realpath($path));
			}
		}
	}

	private static function delete_path($path)
	{
		if (is_dir($path))
		{
			return \File::delete_dir($path);
		} elseif (is_file($path))
		{
			return \File::delete($path);
		}

		return false;
	}

	private static function generate($group, $type, $path)
	{
		$fmt = 'php oil test --group=%s --coverage-%s=%s';
		$cmd = escapeshellcmd(sprintf($fmt, $group, $type, $path));
		$output = null;

		exec($cmd, $output);
		\Cli::write($output);
	}

}

/* End of file tasks/coverage.php */
