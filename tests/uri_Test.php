<?php

/**
* Test Uri class.
*
* @group App
*/
class Test_Uri extends TestCase
{
	protected function setUp()
	{
	}

	protected function tearDown()
	{
	}

	public function test_referrer()
	{
		$this->assertFalse(Uri::referrer());

		$_SERVER['HTTP_REFERER'] = Uri::base();
		$this->assertEquals($_SERVER['HTTP_REFERER'], Uri::referrer());
	}

}
