<?php

namespace srag\Notifications4Plugin\Notification;

use srag\DIC\DICTrait;
use srag\Notifications4Plugin\Utils\Notifications4PluginsTrait;

/**
 * Class Factory
 *
 * @package srag\Notifications4Plugin\Notification
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory {

	use DICTrait;
	use Notifications4PluginsTrait;
	/**
	 * @var self[]
	 */
	protected static $instances = [];


	/**
	 * @param string $notification_class
	 *
	 * @return self
	 */
	public static function getInstance(string $notification_class): self {
		if (!isset(self::$instances[$notification_class])) {
			self::$instances[$notification_class] = new self($notification_class);
		}

		return self::$instances[$notification_class];
	}


	/**
	 * @var string|AbstractNotification
	 */
	protected $notification_class;


	/**
	 * Factory constructor
	 *
	 * @param string $notification_class
	 */
	private function __construct(string $notification_class) {
		$this->notification_class = $notification_class;
	}


	/**
	 * @return AbstractNotification
	 */
	public function newInstance(): AbstractNotification {
		$notification = new $this->notification_class();

		return $notification;
	}
}