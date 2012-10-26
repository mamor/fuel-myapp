<?php
class Model_Base extends \Orm\Model
{

	public static function get_fieldset($id = null, $form_attributes = array(), $name = 'default')
	{
		$model = is_numeric($id) ? static::find_by_id($id) : null;

		$fieldset = Fieldset::forge($name, array('form_attributes' => $form_attributes))
			->add_model(get_called_class())->populate($model);

		$fieldset->add('id', 'id', array('type'=>'hidden', 'value'=>$id));

		$fieldset->add(
			Config::get('security.csrf_token_key'),
			Config::get('security.csrf_token_key'),
			array('type' => 'hidden', 'value' => null));
	
		return $fieldset;
	}

}
