<?php

/**
* Test My_Exception class.
*
* @group App
*/
class Test_My_Exception extends TestCase
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

	public function test_construct()
	{
		try
		{
			throw new My_Exception('test');
		}
		catch(My_Exception $e)
		{
			$this->assertEquals('test', $e->getMessage());
		}
	}
}
