<?php

class My_Date extends Date
{
	/**
	 * Get first day on target month
	 *
	 * @param string $yyyymm
	 * @param int $add_month
	 * @param int $fmt
	 * @return string
	 */
	public static function get_first_day($yyyymm = null, $add_month = 0, $fmt = 'Y-m-d')
	{
		! $yyyymm and $yyyymm = date('Ym');
		$date = date_create($yyyymm.'01');

		date_add($date, date_interval_create_from_date_string($add_month.' month'));

		return date_format($date, $fmt);
	}

	/**
	 * Get last day on target month
	 *
	 * @param string $yyyymm
	 * @param int $add_month
	 * @param int $fmt
	 * @return string
	 */
	public static function get_last_day($yyyymm = null, $add_month = 0, $fmt = 'Y-m-d')
	{
		! $yyyymm and $yyyymm = date('Ym');
		$date = date_create($yyyymm.'01');

		date_add($date, date_interval_create_from_date_string(($add_month + 1).' month'));
		date_sub($date, date_interval_create_from_date_string('1 day'));

		return date_format($date, $fmt);
	}

}
