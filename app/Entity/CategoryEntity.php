<?php 

namespace App\Entity;

use \Core\Entity\Entity;

class CategoryEntity extends Entity{

	public function getURL(){
		return "index.php?page=categorie&id={$this->id}";
	}
}