<?php
namespace Fuel\Tasks;

/**
 * Generate Code Coverage Report.
 *
 * @author     Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright  2012 Mamoru Otsuka
 * @license    WTFPL http://sam.zoy.org/wtfpl/COPYING
 */
class Coverage
{
	const DIR = '../coverage';

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
	 * Generate Code Coverage Report for HTML.
	 *
	 * Usage (from command line):
	 *
	 * php oil r coverage:html [dir [group ]
	 */
	public static function html($dir = null, $group = 'App')
	{
		$dir = $dir ? $dir : static::DIR;
		static::check_dir($dir);
		static::coverage($group, 'html', $dir);
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

Commands:
  php oil r coverage:html [dir [group ]
  php oil r coverage:help

HELP;
		\Cli::write($output);
	}

	/*******************************************************
	 * Private Methods
	 ******************************************************/
	private static function check_dir($dir)
	{
		if(file_exists($dir))
		{
			if ( ! \Cli::option('f'))
			{
				throw new \Exception(realpath($dir).' already exist, please use -f option to force delete and generate.');
			}

			if ( ! static::delete_dir($dir))
			{
				throw new \Exception('Could not delete '.realpath($dir));
			}
		}
	}

	private static function delete_dir($dir)
	{
		if (is_dir($dir))
		{
			return \File::delete_dir($dir);
		} else if (is_file($dir))
		{
			return \File::delete($dir);
		}

		return false;
	}

	private static function coverage($group, $type, $dir)
	{
		$fmt = 'php oil test --group=%s --coverage-%s=%s';
		$cmd = escapeshellcmd(sprintf($fmt, $group, $type, $dir));
		$output = null;

		exec($cmd, $output);
		\Cli::write($output);
	}

}

/* End of file tasks/coverage.php */
