<?php

namespace srag\Notifications4Plugin\Utils;

use srag\Notifications4Plugin\Repository as NotificationRepository;
use srag\Notifications4Plugin\RepositoryInterface as NotificationRepositoryInterface;

/**
 * Trait Notifications4PluginTrait
 *
 * @package srag\Notifications4Plugin\Utils
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
trait Notifications4PluginTrait
{

    /**
     * @return NotificationRepositoryInterface
     */
    protected static function notifications4plugin() : NotificationRepositoryInterface
    {
        return NotificationRepository::getInstance();
    }
}
