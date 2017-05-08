<?php

namespace App\Model;

use \Core\Model\Model;

/**
     * Gère les accès à la BDD pour les articles
*/

class PostModel extends Model {

	 /**
     * Récupère un article
     * @param  int $id : id de l'article
     * @return object $post : article récupéré
     */

	public function get($id){
		$post = $this->query("
			SELECT posts.id as id, posts.title as title, posts.content as content, posts.date as date, posts.category_id as category_id, categories.title as category
			FROM posts
			LEFT JOIN categories ON posts.category_id = categories.id
			WHERE posts.id = :id
			", ['id' => $id], true, true);
		return $post;
	}

	/**
     * Récupère tous les articles
     * @return array $posts : les articles récupéré
     */
    
	public function getAll(){
		$posts  = $this->query("
			SELECT posts.id as id, posts.title as title, posts.content as content, posts.date as date, posts.category_id as category_id, categories.title as category
			FROM posts
			LEFT JOIN categories ON posts.category_id = categories.id
			ORDER BY posts.id DESC
			", null, true, false);
		return $posts;
	}


	/**
     * Récupère les derniers articles
     * @param   int $limit : nombre d'articles souhaité
     * @return array $posts : les articles récupéré
     */
    
	public function getLast(int $limit){
		$posts  = $this->query("
			SELECT posts.id as id, posts.title as title, posts.content as content, posts.date as date, posts.category_id as category_id, categories.title as category
			FROM posts
			LEFT JOIN categories ON posts.category_id = categories.id
			ORDER BY posts.id DESC
			LIMIT ".$limit."
			", null, true, false);
		return $posts;
	}

	/**
     * Récupère les derniers articles d'une catégorie
     * @param   int $id : id de la catégorie
     * @return array $postsByCategories : les articles récupéré
     */

	public function getPostsByCategory($id){
		$postsByCategories  = $this->query("
			SELECT posts.id as id, posts.title as title, posts.content as content, posts.date as date, posts.category_id as category_id, categories.title as category
			FROM posts
			LEFT JOIN categories ON posts.category_id = categories.id
			WHERE posts.category_id = :id
			ORDER BY posts.date DESC
			LIMIT 5
			", ['id' => $id], true, false);
		return $postsByCategories;
	}	

	/**
     * Update un article
     * @param   int $id : id de l'article
     * @param   array $datas : les données à mettre à jour
     * @return bool : information sur le succes de la mise à jour
     */

	public function update(int $id, array $datas){
		$date = date("Y-m-d H:i:s");
		$attributes = [
			'date' => $date
		];
		foreach ($datas as $key => $value) {
			$attributes[$key] = $value;
		}
		return parent::update($id, $attributes);
	}
}