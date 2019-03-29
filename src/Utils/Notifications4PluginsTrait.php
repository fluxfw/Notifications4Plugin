<?php

namespace srag\Notifications4Plugin\Utils;

use srag\Notifications4Plugin\Notification\Language\Repository as NotificationLanguageRepository;
use srag\Notifications4Plugin\Notification\Repository as NotificationRepository;
use srag\Notifications4Plugin\Parser\Repository as ParserRepository;
use srag\Notifications4Plugin\Sender\Repository as SenderRepository;
use srag\Notifications4Plugin\UI\UI as NotificationUI;

/**
 * Trait Notifications4PluginsTrait
 *
 * @package srag\Notifications4Plugin\Utils
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
trait Notifications4PluginsTrait {

	/**
	 * @param string $notification_class
	 * @param string $language_class
	 *
	 * @return NotificationRepository
	 */
	protected static function notification(string $notification_class, string $language_class): NotificationRepository {
		return NotificationRepository::getInstance($notification_class, $language_class);
	}


	/**
	 * @param string $language_class
	 *
	 * @return NotificationLanguageRepository
	 */
	protected static function notificationLanguage(string $language_class): NotificationLanguageRepository {
		return NotificationLanguageRepository::getInstance($language_class);
	}


	/**
	 * @return NotificationUI
	 */
	protected static function notificationUI(): NotificationUI {
		return NotificationUI::getInstance();
	}


	/**
	 * @return ParserRepository
	 */
	protected static function parser(): ParserRepository {
		return ParserRepository::getInstance();
	}


	/**
	 * @return SenderRepository
	 */
	protected static function sender(): SenderRepository {
		return SenderRepository::getInstance();
	}
}
