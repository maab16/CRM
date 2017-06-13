<?php

namespace Blab\Libs;

use Blab\Libs\Configuration;

class defaultSettings
{
	public function __construct(){

		$configuration = new Configuration(array(
					"type" => "ini"
				));
		$path = ROOT.DS.'App'.DS.'Config'.DS.'default';
		$configuration = $configuration->initialize();
		$parsed = $configuration->parse($path);
		Registry::set("default",$parsed->default);
	}
}