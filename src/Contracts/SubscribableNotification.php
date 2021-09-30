<?php


namespace Asantibanez\LaravelSubscribableNotifications\Contracts;


interface SubscribableNotification
{
    public static function dispatch();

    public static function subscribers();

    public static function subscribableNotificationType(): string;
}