<?php

namespace srag\Notifications4Plugin\Notification;

use srag\DataTable\Component\Data\Data;
use srag\DataTable\Component\Data\Row\RowData;
use srag\DataTable\Component\Settings\Settings;
use srag\DataTable\Component\Table;
use srag\DataTable\Implementation\Column\Formatter\Actions\AbstractActionsFormatter;
use srag\DataTable\Implementation\Data\Fetcher\AbstractDataFetcher;
use srag\DIC\DICTrait;
use srag\Notifications4Plugin\Utils\Notifications4PluginTrait;

/**
 * Class NotificationsTable
 *
 * @package srag\Notifications4Plugin\Notification
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class NotificationsTable
{

    use DICTrait;
    use Notifications4PluginTrait;
    /**
     * @var NotificationsCtrl
     */
    protected $parent;


    /**
     * NotificationsTable constructor
     *
     * @param NotificationsCtrl $parent
     */
    public function __construct(NotificationsCtrl $parent)
    {
        $this->parent = $parent;
    }


    /**
     * @return Table
     */
    public function build() : Table
    {
        $table = self::notifications4plugin()->dataTable()->table("notifications4plugin_" . self::notifications4plugin()->getPlugin()->getPluginObject()->getId(),
            self::dic()->ctrl()->getLinkTarget($this->parent, NotificationsCtrl::CMD_LIST_NOTIFICATIONS),
            "", [
                self::notifications4plugin()->dataTable()->column()->column("title",
                    self::notifications4plugin()->getPlugin()->translate("title", NotificationsCtrl::LANG_MODULE))
                    ->withDefaultSort(true),
                self::notifications4plugin()->dataTable()->column()->column("description",
                    self::notifications4plugin()->getPlugin()->translate("description", NotificationsCtrl::LANG_MODULE)),
                self::notifications4plugin()->dataTable()->column()->column("name",
                    self::notifications4plugin()->getPlugin()->translate("name", NotificationsCtrl::LANG_MODULE)),
                self::notifications4plugin()->dataTable()->column()->column("actions",
                    self::notifications4plugin()->getPlugin()->translate("actions", NotificationsCtrl::LANG_MODULE))->withFormatter(new class() extends AbstractActionsFormatter {

                    use Notifications4PluginTrait;


                    /**
                     * @inheritDoc
                     */
                    protected function getActions(RowData $row) : array
                    {
                        self::dic()->ctrl()->setParameterByClass(NotificationCtrl::class, NotificationCtrl::GET_PARAM_NOTIFICATION_ID, $row("id"));

                        return [
                            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("edit", NotificationsCtrl::LANG_MODULE), self::dic()->ctrl()
                                ->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_EDIT_NOTIFICATION)),
                            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("duplicate", NotificationsCtrl::LANG_MODULE), self::dic()->ctrl()
                                ->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_DUPLICATE_NOTIFICATION)),
                            self::dic()->ui()->factory()->link()->standard(self::notifications4plugin()->getPlugin()->translate("delete", NotificationsCtrl::LANG_MODULE), self::dic()->ctrl()
                                ->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_DELETE_NOTIFICATION_CONFIRM))
                        ];
                    }
                })
            ],
            new class() extends AbstractDataFetcher {

                use Notifications4PluginTrait;


                /**
                 * @inheritDoc
                 */
                public function fetchData(Settings $settings) : Data
                {
                    return self::notifications4plugin()->dataTable()->data()->data(array_map(function (NotificationInterface $notification
                    ) : RowData {
                        return self::notifications4plugin()->dataTable()->data()->row()->getter($notification->getId(), $notification);
                    }, self::notifications4plugin()->notifications()->getNotifications($settings)),
                        self::notifications4plugin()->notifications()->getNotificationsCount());
                }
            })->withPlugin(self::notifications4plugin()->getPlugin());

        return $table;
    }


    /**
     * @return string
     */
    public function render() : string
    {
        self::dic()->toolbar()->addComponent(self::dic()->ui()->factory()->button()->standard(self::notifications4plugin()->getPlugin()->translate("add_notification", NotificationsCtrl::LANG_MODULE),
            self::dic()->ctrl()
                ->getLinkTargetByClass(NotificationCtrl::class, NotificationCtrl::CMD_ADD_NOTIFICATION)));

        return self::output()->getHTML($this->build());
    }
}
