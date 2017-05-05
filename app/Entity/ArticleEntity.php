<?php 

namespace App\Entity;

use \Core\Entity\Entity;

/**
 * 
 */

class ArticleEntity extends Entity {

	public function getURL(){
		return 'index.php?page=article&id=' . $this->id;
	}

	public function getExtrait(){
		$html = '<p>'.substr($this->contenu, 0, 300) . '...</p>';
		$html .= '<a href="'.$this->getURL().'">Voir la suite</a>';
		return $html;
	}
}