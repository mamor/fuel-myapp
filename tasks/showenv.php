<?php
namespace Fuel\Tasks;

/**
 * Confirmation Fuel::$env on server.
 *
 * @author     Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright  2013 Mamoru Otsuka
 * @license    WTFPL http://sam.zoy.org/wtfpl/COPYING
 */
class Showenv
{
	public static function run()
	{
		\Cli::write(\Fuel::$env);
	}
}

/* End of file tasks/showenv.php */
