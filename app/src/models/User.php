<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	protected $table = 'users';
	protected $fillable = ['chat_id', 'youtrack_id'];
}