<?php
/**
 * https://github.com/kenjis/fuelphp1st のソースに変更を加えています。
 * 
 * @author    Mamoru Otsuka http://madroom-project.blogspot.jp/
 * @copyright 2013 Mamoru Otsuka
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 */

/**
 * 電子書籍『はじめてのフレームワークとしてのFuelPHP』の一部です。
 *
 * @version    1.0
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2012 Kenji Suzuki
 * @link       https://github.com/kenjis/fuelphp1st
 */
class DbFixture
{
	public static $active;
	public static $table_prefix;
	public static $phpunit_table_prefix;

	public static function _init()
	{
		Config::load('db', true);

		static::$active = Config::get('db.active');
		static::$table_prefix = Config::get('db.'.static::$active.'.table_prefix');
		static::$phpunit_table_prefix = 'phpunit_'.static::$table_prefix;
	}

	// フィクスチャファイルの形式
	protected static $file_type = 'yaml';
	protected static $file_ext  = 'yml';

	protected static $loaded = false;

	public static function load($table, $file, $reload = false)
	{
		if ( ! $reload and static::$loaded)
		{
			return;
		}
		static::$loaded = true;

		static::create_table_like($table);
		$table = static::$phpunit_table_prefix.$table;

		$fixt_name = $file . '_fixt';
		$file_name = $fixt_name . '.' . static::$file_ext;
		$fixt_file = APPPATH . 'tests/fixture/' . $file_name;

		if ( ! file_exists($fixt_file))
		{
			exit('No such file: ' . $fixt_file . PHP_EOL);
		}

		// フィクスチャファイルを読み込んで配列に変換
		$data = file_get_contents($fixt_file);
		$data = Format::forge($data, static::$file_type)->to_array();

		// テーブルのデータを削除
		static::empty_table($table);

		// フィクスチャデータの挿入
		foreach ($data as $row)
		{
			if ( !is_array($row))
			{
				continue;
			}

			list($insert_id, $rows_affected) = 
				DB::insert($table)->set($row)->execute();
		}

		$ret = Log::info(
			'Table Fixture ' . $file_name . ' -> ' . $fixt_name . ' loaded',
			__METHOD__
		);

		return $data;
	}

	// テーブルのデータを削除
	protected static function empty_table($table)
	{
		if (DBUtil::table_exists($table))
		{
			DBUtil::truncate_table($table);
		}
		else
		{
			exit('No such table: ' . $table . PHP_EOL);
		}
	}

	protected static function create_table_like($table)
	{
		$from_table = static::$table_prefix.$table;
		$to_table = static::$phpunit_table_prefix.$table;

		$sql = "drop table if exists {$to_table}";
		DB::query($sql)->execute();

		$sql = "create table if not exists {$to_table} like {$from_table}";
		DB::query($sql)->execute();
	}

}
