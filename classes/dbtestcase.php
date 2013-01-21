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
	// フィクスチャデータ
	protected $tables = array(
		// テーブル名 => ファイル名
	);

	protected function setUp()
	{
		parent::setUp();

		if ( ! empty($this->tables))
		{
			$this->dbfixt($this->tables);

			// DB設定をリフレッシュしてユニットテスト用のテーブルプレフィックスを設定
			$config = Config::get('db');
			Config::delete('db');
			$config[DbFixture::$active]['table_prefix'] = DbFixture::$test_table_prefix;
			Config::set('db', $config);

			Database_Connection::$instances = array();
			Database_Connection::instance(DbFixture::$active, $config[DbFixture::$active]);
		}
	}

	protected function tearDown()
	{
		if ( ! empty($this->tables))
		{
			// DB設定をリフレッシュしてテーブルプレフィックスを元に戻す
			$config = Config::get('db');
			Config::delete('db');
			$config[DbFixture::$active]['table_prefix'] = DbFixture::$table_prefix;
			Config::set('db', $config);

			Database_Connection::$instances = array();
			Database_Connection::instance(DbFixture::$active, $config[DbFixture::$active]);
		}

		parent::tearDown();
	}

	protected function dbfixt($tables)
	{
		// $this->dbfixt('table1', 'table2', ...)という形式もサポート
		$tables = is_string($tables) ? func_get_args() : $tables;

		foreach ($tables as $table => $file)
		{
			$fixt_name = $file . '_fixt';
			$this->$fixt_name = DbFixture::load($table, $file);
		}
	}
}
