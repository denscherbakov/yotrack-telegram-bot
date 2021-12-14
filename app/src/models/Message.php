<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent
{
	protected $table = 'messages';
	protected $fillable = ['task_id', 'task_short_name', 'task_number_in_project', 'task_updated_at', 'is_sent'];
}