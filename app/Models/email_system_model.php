<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email_system_model extends Model
{
    use HasFactory;
    protected $table = 'email_system';
    protected $fillable = [
        'mail_from',
        'mail_to',
        'mail_from',
        'execution_time',
        'recurring_days',
        'recurring_end',
        'repetition',
        'cc',
        'bcc',
        'attachment',
        'message',
    ];
}

