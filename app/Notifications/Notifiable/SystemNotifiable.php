<?php

namespace App\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SystemNotifiable extends Model
{
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';

    public function __construct()
    {
        $this->id = 'system';
        $this->email = env('MAIL_FROM_ADDRESS');
    }
}
