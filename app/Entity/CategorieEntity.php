<?php 

namespace App\Entity;

use \Core\Entity\Entity;

class CategorieEntity extends Entity{

	public function getURL(){
		return "index.php?page=categorie&id={$this->id}";
	}
}