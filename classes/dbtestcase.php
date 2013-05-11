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
abstract class DbTestCase extends TestCase
{
	// DBコネクション
	public static $active;

	// テーブルプレフィックス
	public static $table_prefix;

	// ユニットテストで使用するテーブルプレフィックス
	public static $test_table_prefix;

	// コピー済テーブル一覧
	protected static $copied;

	// フィクスチャデータ
	protected $tables = array(
		// テーブル名 => ファイル名
	);

	public static function setUpBeforeClass()
	{
		Config::load('db', true);

		static::$active = Config::get('db.active');
		static::$table_prefix = Config::get('db.'.static::$active.'.table_prefix');
		static::$test_table_prefix = '_test_'.static::$table_prefix;
		static $copied = array();

		// DB設定をリフレッシュしてユニットテスト用のテーブルプレフィックスを設定
		$config = Config::get('db');
		Config::delete('db');
		$config[static::$active]['table_prefix'] = static::$test_table_prefix;
		Config::set('db', $config);

		Database_Connection::$instances = array();
		Database_Connection::instance(static::$active, $config[static::$active]);
	}

	public static function tearDownAfterClass()
	{
		// DB設定をリフレッシュしてテーブルプレフィックスを元に戻す
		$config = Config::get('db');
		Config::delete('db');
		$config[static::$active]['table_prefix'] = static::$table_prefix;
		Config::set('db', $config);

		Database_Connection::$instances = array();
		Database_Connection::instance(static::$active, $config[static::$active]);
	}

	protected function setUp()
	{
		parent::setUp();

		if ( ! empty($this->tables))
		{
			$this->dbfixt($this->tables);
		}
	}

	protected function dbfixt($tables)
	{
		// $this->dbfixt('table1', 'table2', ...)という形式もサポート
		$tables = is_string($tables) ? func_get_args() : $tables;

		foreach ($tables as $table => $file)
		{
			if (empty(static::$copied[$table]))
			{
				static::$copied[$table] = true;
				static::create_table_like($table);
			}

			if ($file === false)
			{
				DBUtil::truncate_table($table);
			}
			else
			{
				$this->_fixt[$file] = DbFixture::load($table, $file);
			}
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
