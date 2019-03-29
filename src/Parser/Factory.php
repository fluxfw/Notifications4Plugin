<?php

namespace srag\Notifications4Plugin\Parser;

use srag\DIC\DICTrait;
use srag\Notifications4Plugin\Utils\Notifications4PluginsTrait;

/**
 * Class Factory
 *
 * @package srag\Notifications4Plugin\Parser
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory {

	use DICTrait;
	use Notifications4PluginsTrait;
	/**
	 * @var self
	 */
	protected static $instance = null;


	/**
	 * @return self
	 */
	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Factory constructor
	 */
	private function __construct() {

	}


	/**
	 * @return twigParser
	 */
	public function twig(): twigParser {
		return new twigParser();
	}
}
