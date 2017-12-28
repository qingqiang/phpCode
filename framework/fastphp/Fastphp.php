<?php

namespace fastphp;

// 框架根目录
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class Fastphp {
	
	protected $config = [];

	function __construct($config) {
		$this->config = $config;
	}

	public function run() {
		
	}
}