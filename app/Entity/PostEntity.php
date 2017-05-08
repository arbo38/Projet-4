<?php 

namespace App\Entity;

use \Core\Entity\Entity;

/**
     * Modèle d'objet pour les récuparation d'articles dans la BDD
*/

class PostEntity extends Entity {

	public function getURL(){
		return "index.php?page=article&id=$this->id";
	}

	public function getExtrait(){
		$html = '<p>'.substr($this->content, 0, 300) . '...</p>';
		$html .= "<a class='btn btn-info' href='".$this->getURL()."' >Voir la suite</a>";
		return $html;
	}
}