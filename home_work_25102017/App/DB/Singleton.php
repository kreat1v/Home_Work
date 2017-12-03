<?php

namespace App\DB;

abstract class Singleton
{
	protected static $instance = null;

	abstract protected function __construct ();

	private function __clone () {}
	private function __sleep () {}
	private function __wakeup () {}

	public static function getInstance()
	{
		if (static::$instance == null) {
			static::$instance = new static();
		}

		return static::$instance;
	}
}