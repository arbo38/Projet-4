<?php 

namespace App\Entity;

use \Core\Entity\Entity;

/**
     * Modèle d'objet pour les récuparation de catégorie dans la BDD
*/

class CategoryEntity extends Entity{

	public function getURL(){
		return "index.php?page=category&id={$this->id}";
	}
}