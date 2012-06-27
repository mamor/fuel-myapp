<?php

class DB extends Fuel\Core\DB
{
	public static function start($db = null)
	{
		parent::start_transaction($db);
	}

	public static function commit($db = null)
	{
		parent::commit_transaction($db);
	}

	public static function rollback($db = null)
	{
		parent::rollback_transaction($db);
	}
}
