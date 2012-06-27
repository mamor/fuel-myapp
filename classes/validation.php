<?php

class Validation extends Fuel\Core\Validation
{
	/**
	 * in_array($val, $array)
	 * 
	 * @param   string, array
	 * @return  bool
	 */
	public function _validation_my_in_array_vals($val, $array)
	{
		return $this->_empty($val) || in_array($val, $array);
	}

	/**
	 * in_array($val, array_keys($array))
	 * 
	 * @param   string, array
	 * @return  bool
	 */
	public function _validation_my_in_array_keys($val, $array)
	{
		return $this->_empty($val) || in_array($val, array_keys($array));
	}

	/**
	 * in_array($val, $array) by static array on model
	 * 
	 * @param   string val, string model_name, string array_name
	 * @return  bool
	 */
	public function _validation_my_in_model_static_array_vals($val, $model_name, $array_name)
	{
		$m = new $model_name();
		return $this->_validation_my_in_array_vals($val, $m::${$array_name});
	}

	/**
	 * in_array($val, array_keys($array)) by static array on model
	 * 
	 * @param   string val, string model_name, string array_name
	 * @return  bool
	 */
	public function _validation_my_in_model_static_array_keys($val, $model_name, $array_name)
	{
		$m = new $model_name();
		return $this->_validation_my_in_array_keys($val, $m::${$array_name});
	}

}
