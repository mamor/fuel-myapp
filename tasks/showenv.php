<?php
namespace Fuel\Tasks;

class Showenv
{
	public static function run()
	{
		\Cli::write(\Fuel::$env);
	}
}

/* End of file tasks/showenv.php */
