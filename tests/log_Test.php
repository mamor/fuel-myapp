<?php

/**
* Test Log class.
*
* @group App
*/
class Test_Log extends TestCase
{
	protected function setUp()
	{
		$this->log_threshold = Config::get('log_threshold');
		Config::set('log_threshold', Fuel::L_NONE);
	}

	protected function tearDown()
    {
		Config::set('log_threshold', $this->log_threshold);
    }

	public function test_i()
    {
		$this->assertEquals(Log::i('test'), \Fuel\Core\Log::info('test'));
		$this->assertEquals(Log::i('test', __FUNCTION__), \Fuel\Core\Log::info('test', __FUNCTION__));
    }

	public function test_d()
    {
		$this->assertEquals(Log::d('test'), \Fuel\Core\Log::debug('test'));
		$this->assertEquals(Log::d('test', __FUNCTION__), \Fuel\Core\Log::debug('test', __FUNCTION__));
    }

	public function test_w()
    {
		$this->assertEquals(Log::w('test'), \Fuel\Core\Log::warning('test'));
		$this->assertEquals(Log::w('test', __FUNCTION__), \Fuel\Core\Log::warning('test', __FUNCTION__));
    }

	public function test_e()
    {
		$this->assertEquals(Log::e('test'), \Fuel\Core\Log::error('test'));
		$this->assertEquals(Log::e('test', __FUNCTION__), \Fuel\Core\Log::error('test', __FUNCTION__));
    }
}
