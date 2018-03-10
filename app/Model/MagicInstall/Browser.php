<?php
namespace App\Model\MagicInstall;

use App\Model\Model;

class Browser extends Model{

	protected $connection = 'uu_magic_install';

	protected $table = 'browser';

    public $timestamps = false;
}