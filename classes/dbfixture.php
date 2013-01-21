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
	// DBコネクション
	public static $active;

	// テーブルプレフィックス
	public static $table_prefix;

	// ユニットテストで使用するテーブルプレフィックス
	public static $test_table_prefix;

	// コピー済テーブル一覧
	protected static $copied;

	// 初期化
	public static function _init()
	{
		Config::load('db', true);

		static::$active = Config::get('db.active');
		static::$table_prefix = Config::get('db.'.static::$active.'.table_prefix');
		static::$test_table_prefix = '_test_'.static::$table_prefix;
		static $copied = array();
	}

	// フィクスチャファイルの形式
	protected static $file_type = 'yaml';
	protected static $file_ext  = 'yml';

	public static function load($table, $file)
	{
		// ユニットテスト用にテーブルを複製
		if (empty(static::$copied[$table]))
		{
			static::$copied[$table] = true;
			static::create_table_like($table);
		}
		$table = static::$test_table_prefix.$table;

		$fixt_name = $file . '_fixt';
		$file_name = $fixt_name . '.' . static::$file_ext;
		$fixt_file = APPPATH . 'tests/_fixture/' . $file_name;

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
			if ( ! is_array($row))
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

	// ユニットテスト用にテーブルを複製
	protected static function create_table_like($table)
	{
		$from_table = static::$table_prefix.$table;
		$to_table = static::$test_table_prefix.$table;

		$sql = "drop table if exists {$to_table}";
		DB::query($sql)->execute();

		$sql = "create table if not exists {$to_table} like {$from_table}";
		DB::query($sql)->execute();
	}

}
