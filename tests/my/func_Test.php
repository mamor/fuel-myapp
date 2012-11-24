<?php

/**
* Test My_Func class.
*
* @group App
*/
class Test_My_Func extends TestCase
{
	protected function setUp()
	{
	}

	protected function tearDown()
	{
	}

	public function test_errors_to_array()
	{
		$this->assertEquals(0, count(My_Func::errors_to_array(array())));

		$val = Validation::forge();
		$val->add_field('name', 'label', 'required');
		$val->run(array());
		$this->assertTrue(is_array(My_Func::errors_to_array($val->error())));
		$this->assertEquals(1, count(My_Func::errors_to_array($val->error())));
	}

	public function test_mk_hash()
	{
		$this->assertEquals(1, strlen(My_Func::mk_hash(61)));
		$this->assertEquals(2, strlen(My_Func::mk_hash(62)));
	}

}
