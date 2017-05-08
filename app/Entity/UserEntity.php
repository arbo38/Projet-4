<?php 

namespace App\Entity;

use \Core\Entity\Entity;

/**
     * Modèle d'objet pour les récuparation de Users dans la BDD
*/


class UserEntity extends Entity {
	public function isAdmin(){
		if($this->status == 'admin'){
			return true;
		}
		return false;
	}
}