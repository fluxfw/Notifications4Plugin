<?php

namespace srag\Notifications4Plugin\Notification\Table;

use srag\DataTableUI\Component\Data\Row\RowData;
use srag\DataTableUI\Implementation\Column\Formatter\Actions\AbstractActionsFormatter;
use srag\Notifications4Plugin\Notification\NotificationCtrl;
use srag\Notifications4Plugin\Notification\NotificationsCtrl;
use srag\Notifications4Plugin\Utils\Notifications4PluginTrait;

/**
 * Class ActionsFormatter
 *
 * @package srag\Notifications4Plugin\Notification\Table
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ActionsFormatter extends AbstractActionsFormatter
{

    use Notifications4PluginTrait;


    /**
     * @inheritDoc
     */
    protected function getActions(RowData $row) : array
    {
        self::dic()->ctrl()->setParameterByClass(NotificationCtrl::class, NotificationCtrl::GET_PARAM_NOTIFICATION_ID, $row("id"));

        return [
            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("edit", NotificationsCtrl::LANG_MODULE),
                self::dic()->ctrl()->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_EDIT_NOTIFICATION, "", false, false)),
            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("duplicate", NotificationsCtrl::LANG_MODULE),
                self::dic()->ctrl()->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_DUPLICATE_NOTIFICATION, "", false, false)),
            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("delete", NotificationsCtrl::LANG_MODULE),
                self::dic()->ctrl()->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_DELETE_NOTIFICATION_CONFIRM, "", false, false))
        ];
    }
}
