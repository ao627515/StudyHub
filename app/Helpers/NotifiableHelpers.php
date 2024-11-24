<?php

namespace App\Helpers;

use App\Notifications\Notifiable\SystemNotifiable;

class NotifiableHelpers
{
    public static function SystemNotifiable()
    {
        return new SystemNotifiable();
    }
}
