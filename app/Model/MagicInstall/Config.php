<?php
namespace App\Model\MagicInstall;

use App\Model\Model;

class Config extends Model{

	protected $connection = 'uu_magic_install';

	protected $table = 'config';

	public $timestamps = false;
}