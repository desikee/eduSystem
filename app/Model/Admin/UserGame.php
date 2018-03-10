<?php
namespace App\Model\Admin;

use App\Model\Model;

class UserGame extends Model{

	protected $table = 'user_game';

	public $timestamps = false;

	protected $fillable = ['user_id', 'game_id', 'appid', 'channel_id'];
}