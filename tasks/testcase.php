<?php
namespace Fuel\Tasks;

/**
 * Generate test cases.
 *
 * @author    Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright 2012 Mamoru Otsuka
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * 
 * Use a part of https://github.com/kenjis/fuelphp-tools/blob/master/app/tasks/generate.php
 * @author    Kenji Suzuki https://github.com/kenjis
 * @copyright 2012 Kenji Suzuki
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * 
 * 
 */
class Testcase
{
	private static $file_name_fmt = '%s_Test'; // For MakeGood
	private static $class_name_fmt = 'Test_%s';
	private static $method_name_fmt = 'test_%s';
	private static $tests_dir = null;

	public function __construct()
	{
		static::$tests_dir = APPPATH.'tests'.DS;
	}

	/**
	 * Show help
	 *
	 * Usage (from command line):
	 *
	 * php oil r testcase
	 */
	public static function run()
	{
		static::help();
	}

	/**
	 * Show help
	 *
	 * Usage (from command line):
	 *
	 * php oil r testcase:help
	 */
	public static function help()
	{
		$output = <<<HELP

Description:
  Generate test cases.

Commands:
  php oil refine testcase:generate
  php oil refine testcase:help

HELP;
		\Cli::write($output);
	}

	/**
	 * Generate test cases.
	 *
	 * Usage (from command line):
	 *
	 * php oil r testcase:generate
	 */
	public static function generate()
	{
		$filelist = \File::read_dir(APPPATH.'classes');
		$filelist = static::convert_filelist($filelist);

		foreach ($filelist as $file)
		{
			$dirs = explode(DS, $file);

			$file = array_pop($dirs);
			$dir = implode(DS, $dirs).DS;

			// Create directory
			try
			{
				\File::create_dir(static::$tests_dir, $dir, 0755);			
			}
			catch (\FileAccessException $e)
			{
				// Do nothing
			}

			$basename = basename($file, '.php');
			$class_name = \Inflector::words_to_upper(str_replace(DS, '_', $dir.$basename));
			$file_name = sprintf(static::$file_name_fmt, $basename).'.php';

			// Generate test case
			if ( ! file_exists(static::$tests_dir.$dir.$file_name))
			{
				$contents = static::get_contents($class_name);
				\File::create(static::$tests_dir.$dir, $file_name, $contents);

				\Cli::write('"'.static::$tests_dir.$dir.$file_name.'"'.' was generated.', 'green');
			}
			else
			{
				\Cli::write('"'.static::$tests_dir.$dir.$file_name.'"'.' already exists, skipped generation.');
			}

		}
	}

	/*******************************************************
	 * Private Methods
	 ******************************************************/
	private static function get_contents($class_name)
	{
		$class_fmt = <<<CLASS_FMT
<?php

/**
 * %s class tests
 *
 * @group App
 */
class %s extends TestCase
{
%%s
}

CLASS_FMT;

		$method_fmt = <<<METHOD_FMT

	/**
	 * Tests %s::%s()
	 *
	 * @test
	 */
	public function %s()
	{
		//TODO: %s() has not been implemented yet.
		\$this->markTestIncomplete(
			'%s() has not been implemented yet.'
		);
	}

METHOD_FMT;

		$contents_fmt = sprintf($class_fmt, $class_name, sprintf(static::$class_name_fmt, $class_name));

		$methods = static::get_subclass_methods($class_name);
//		$methods = array_diff(get_class_methods($class_name), get_class_methods(get_parent_class($class_name)));
		$method_str = '';

		foreach ($methods as $method)
		{
			$method_name = sprintf(static::$method_name_fmt, $method);

			$method_str .= sprintf(
				$method_fmt,
				$class_name,
				$method_name,
				$method_name,
				$method_name,
				$method_name
			);
		}

		return sprintf($contents_fmt, $method_str);
	}

	private static function get_subclass_methods($class_name)
	{
		$rc = new \ReflectionClass($class_name);
		$rm = $rc->getMethods(\ReflectionMethod::IS_PUBLIC);

		$methods = array();
		foreach ($rm as $method)
		{
			$method->class === $class_name and $methods[] = $method->name;
		}

		return $methods;
	}

	/**
	 * Convert Filelist Array to Single Dimension Array
	 *
	 * @param  array  filelist array of \File::read_dir()
	 * @param  string directory
	 * @return array
	 */
	private static function convert_filelist($arr, $dir = '')
	{
		static $list = array();

		foreach ($arr as $key => $val)
		{
			if (is_array($val))
			{
				static::convert_filelist($val, $dir . $key);
			}
			else
			{
				$list[] = $dir . $val;
			}
		}

		return $list;
	}

}

/* End of file tasks/testcase.php */
