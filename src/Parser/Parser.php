<?php

namespace srag\Notifications4Plugin\Parser;

use srag\Notifications4Plugin\Exception\Notifications4PluginsException;

/**
 * Interface Parser
 *
 * @package srag\Notifications4Plugin\Parser
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  Stefan Wanzenried <sw@studer-raimann.ch>
 */
interface Parser {

	/**
	 * @param string $text
	 * @param array  $placeholders
	 *
	 * @return string
	 *
	 * @throws Notifications4PluginsException
	 */
	public function parse(string $text, array $placeholders = array()): string;
}
