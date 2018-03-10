<?php
namespace App\Model\MagicInstall;

use App\Model\Model;

class Link extends Model{

	protected $connection = 'uu_magic_install';

	protected $table = 'link';

	const CREATED_AT = 'created';

	const UPDATED_AT = 'updated';
}