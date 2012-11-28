<?php

class My_Github
{

	const AUTHORIZE_URL = 'https://github.com/login/oauth/authorize';
	const GET_ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';
	const GET_USER_URL = 'https://api.github.com/user';

	public static function authorize($client_id, $params = array())
	{
		$params = array_merge(array('client_id' => $client_id), $params);
		Response::redirect(static::AUTHORIZE_URL.'?'.http_build_query($params));
	}

	public static function get_access_token($client_id, $client_secret, $code, $params = array())
	{
		$params = array_merge(
			array(
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'code' => $code,
			),
			$params
		);

		$context = stream_context_create(array('http' => array(
			'method' => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => http_build_query($params),
		)));

		$access_token = file_get_contents(static::GET_ACCESS_TOKEN_URL, false, $context);
		parse_str($access_token, $access_token);

		return $access_token;
	}

	public static function get_user($access_token, $params = array())
	{
		$params = array_merge(array('access_token' => $access_token), $params);
		$json = file_get_contents(static::GET_USER_URL.'?'.http_build_query($params));
		return json_decode($json);
	}

}
