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
		$fmt = 'php oil test --group=%s --coverage-html=%s';
		$dir = $dir ? $dir : static::DIR;

		if (is_dir($dir))
		{
			\File::delete_dir($dir);
		}

		$cmd = escapeshellcmd(sprintf($fmt, $group, $dir));
		$output = null;

		exec($cmd, $output);
		\Cli::write($output);
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
}

/* End of file tasks/coverage.php */
