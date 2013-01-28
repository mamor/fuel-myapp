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
require_once APPPATH . 'vendor/Goutte/goutte.phar';
use Goutte\Client;

abstract class FunctionalTestCase extends DbTestCase
{

	protected static $client;  // Clientオブジェクト
	protected static $crawler; // Crawlerオブジェクト

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		// .htaccessをテスト環境用に変更
		$htaccess = DOCROOT . 'public/.htaccess';
		$htaccess_test = APPPATH . 'tests/_files/.htaccess.test';
		$htaccess_develop = APPPATH . 'tests/_files/.htaccess.develop';
		if ( ! file_exists($htaccess_develop))
		{
			$ret = rename($htaccess, $htaccess_develop);
			if ($ret === false)
			{
				exit('Error: can\'t backup ".htaccess" !');
			}
		}
		$ret = copy($htaccess_test, $htaccess);
		if ($ret === false)
		{
			exit('Error: can\'t copy ".htaccess.test" !');
		}

		// bootstrap.phpをテスト環境用に変更
		$bootstrap = APPPATH . 'bootstrap.php';
		$bootstrap_test = APPPATH . 'tests/_files/bootstrap.php.test';
		$bootstrap_develop = APPPATH . 'tests/_files/bootstrap.php.develop';
		if ( ! file_exists($bootstrap_develop))
		{
			$ret = rename($bootstrap, $bootstrap_develop);
			if ($ret === false)
			{
				exit('Error: can\'t backup "bootstrap.php" !');
			}
		}
		$ret = copy($bootstrap_test, $bootstrap);
		if ($ret === false)
		{
			exit('Error: can\'t copy "bootstrap.php.test" !');
		}

		// GoutteのClientオブジェクトを生成
		static::$client = new Client();
	}

	public static function tearDownAfterClass()
	{
		static::$client  = null;
		static::$crawler = null;

		// .htaccessを開発環境用に戻す
		$htaccess = DOCROOT . 'public/.htaccess';
		$htaccess_develop = APPPATH . 'tests/_files/.htaccess.develop';
		copy($htaccess_develop, $htaccess);

		// bootstrap.phpを開発環境用に戻す
		$bootstrap = APPPATH . 'bootstrap.php';
		$bootstrap_develop = APPPATH . 'tests/_files/bootstrap.php.develop';
		copy($bootstrap_develop, $bootstrap);

		parent::tearDownAfterClass();
	}

}
