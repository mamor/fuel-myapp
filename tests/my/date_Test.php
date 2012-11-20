<?php

/**
* Test My_Date class.
*
* @group App
*/
class Test_My_Date extends TestCase
{
	protected function setUp()
	{
	}

	protected function tearDown()
	{
	}

	public function test_get_first_day()
	{
		//this month (Y-m-d)
		$expected = date('Y-m-').'01';
		$actual = My_Date::get_first_day();
		$this->assertEquals($expected, $actual);

		//13 months after from 2000-01
		$expected = '2001-02-01';
		$actual = My_Date::get_first_day('200001', 13);
		$this->assertEquals($expected, $actual);

		//13 months before from 2000-01
		$expected = '19981201000000';
		$actual = My_Date::get_first_day('200001', -13, 'YmdHis');
		$this->assertEquals($expected, $actual);
	}

	public function test_get_last_day()
	{
		//this month
		$date = date_create(date('Ym').'01');
		date_add($date, date_interval_create_from_date_string('1 month'));
		date_sub($date, date_interval_create_from_date_string('1 day'));

		$expected = date_format($date, 'Y-m-d');
		$actual = My_Date::get_last_day();
		$this->assertEquals($expected, $actual);

		//13 months after from 2000-01
		$date = date_create('200102'.'01');
		date_add($date, date_interval_create_from_date_string('1 month'));
		date_sub($date, date_interval_create_from_date_string('1 day'));

		$expected = date_format($date, 'Y-m-d');
		$actual = My_Date::get_last_day('200001', 13);
		$this->assertEquals($expected, $actual);

		//13 months before from 2000-01
		$date = date_create('199812'.'01');
		date_add($date, date_interval_create_from_date_string('1 month'));
		date_sub($date, date_interval_create_from_date_string('1 day'));

		$expected = date_format($date, 'YmdHis');
		$actual = My_Date::get_last_day('200001', -13, 'YmdHis');
		$this->assertEquals($expected, $actual);
	}

}
