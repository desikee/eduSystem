<?php
namespace App\Model\MagicInstall;

use App\Model\Model;

class Device extends Model{

	protected $connection = 'uu_magic_install';

	protected $table = 'device';

	protected $timestamps = false;
}