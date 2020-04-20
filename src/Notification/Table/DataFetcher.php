<?php

namespace srag\Notifications4Plugin\Notification\Table;

use srag\DataTableUI\Component\Data\Data;
use srag\DataTableUI\Component\Data\Row\RowData;
use srag\DataTableUI\Component\Settings\Settings;
use srag\DataTableUI\Implementation\Data\Fetcher\AbstractDataFetcher;
use srag\Notifications4Plugin\Notification\NotificationInterface;
use srag\Notifications4Plugin\Utils\Notifications4PluginTrait;

/**
 * Class DataFetcher
 *
 * @package srag\Notifications4Plugin\Notification\Table
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class DataFetcher extends AbstractDataFetcher
{

    use Notifications4PluginTrait;

    /**
     * @inheritDoc
     */
    public function fetchData(Settings $settings) : Data
    {
        return self::dataTableUI()->data()->data(array_map(function (NotificationInterface $notification
        ) : RowData {
            return self::dataTableUI()->data()->row()->getter($notification->getId(), $notification);
        }, self::notifications4plugin()->notifications()->getNotifications($settings)),
            self::notifications4plugin()->notifications()->getNotificationsCount());
    }
}
