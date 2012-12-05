<?php
namespace Fuel\Tasks;

/**
 * Generate PHP Documentation.
 *
 * @author     Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright  2012 Mamoru Otsuka
 * @license    WTFPL http://sam.zoy.org/wtfpl/COPYING
 */
class Phpdoc
{
	const DEFAULT_INPUT_PATH = 'fuel/app/classes/';
	const DEFAULT_OUTPUT_PATH = '../phpdoc/';

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r phpdoc
	 */
	public static function run()
	{
		static::help();
	}

	/**
	 * Generate PHP Documentation for html.
	 *
	 * Usage (from command line):
	 *
	 * php oil r phpdoc:html [ignore_paths [input_path [output_path ]
	 */
	public static function html($ignore_paths = '', $input_path = '', $output_path = '')
	{
		! $input_path and $input_path = self::DEFAULT_INPUT_PATH;
		$input_path = rtrim($input_path, '/').'/';

		! $output_path and $output_path = self::DEFAULT_OUTPUT_PATH;
		$output_path = rtrim($output_path, '/').'/';

		strlen($ignore_paths) and $ignore_paths = $input_path.implode(','.$input_path, explode(',', $ignore_paths));

		static::check_path($output_path);
		static::generate($input_path, $output_path, $ignore_paths);
	}

	/**
	 * Show help.
	 *
	 * Usage (from command line):
	 *
	 * php oil r phpdoc:help
	 */
	public static function help()
	{
		$output = <<<HELP

Description:
  Generate PHP Documentation.

Runtime options:
  -f, [--force]    # Force delete and generate PHP Documentation that already exist

Commands:
  php oil r phpdoc:html [ignore_paths [input_path [output_path ]
  php oil r phpdoc:help

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

	private static function generate($input_path, $output_path, $ignore_paths)
	{
		strlen($ignore_paths) and $ignore_paths = ' --ignore '.$ignore_paths;

		$fmt = 'phpdoc -d %s -t %s %s';
		$cmd = escapeshellcmd(sprintf($fmt, $input_path, $output_path, $ignore_paths));
		$output = null;

		exec($cmd, $output);
		\Cli::write($output);
	}

}

/* End of file tasks/phpdoc.php */
