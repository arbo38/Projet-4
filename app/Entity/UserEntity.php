<?php 

namespace App\Entity;

use \Core\Entity\Entity;

/**
 * 
 */

class UserEntity extends Entity {
	public function isAdmin(){
		if($this->user_type == 'ADMINISTRATEUR'){
			return true;
		}
		return false;
	}
}