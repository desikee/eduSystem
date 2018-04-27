<?php
namespace App\Model\Admin;

use App\Model\Model;

class PlayerPay extends Model{

	protected $table = 'player_pay';

	protected $fillable = ['link_id', 'player_id', 'game_id', 'channel_id', 'pay', 'device_id'];
}