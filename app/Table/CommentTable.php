<?php

namespace App\Table;

use \Core\Table\Table;

class CommentTable extends Table {

	public function find($id)
    {
        // On récupère le commentaire à supprimer
        $comment = $this->query("
         SELECT *
         FROM comments
         WHERE id = :id
         ", ['id' => $id], true, true);

        if ($comment === false) {
            throw new \Exception("Ce commentaire n'existe pas");
        }
        return $comment;
    }

    public function findAllByArticle(array $articles){
        $commentsByArticles = [];
        foreach ($articles as $article) {
            $key = $article->titre . ' - ' . $article->id;
            $commentsByArticles[$key] = $this->query("SELECT articles.id AS articleId, articles.titre as articleTitle, comments.id as id, comments.comment as content, comments.pseudo as pseudo FROM `articles` LEFT JOIN comments ON articles.id = comments.post_id WHERE articles.id = ".$article->id."
                ");
        }
        return $commentsByArticles;
    }

    public function findLast(int $number)
    {
        // On récupère le commentaire à supprimer
        $comments = $this->query("
         SELECT comments.id as id, pseudo, comments.comment as content, articles.titre as articleTitle, articles.id as post_id 
         FROM comments
         LEFT JOIN articles ON comments.post_id = articles.id
         ORDER BY id DESC
         LIMIT ".$number."
         ", false, true, false);

        if ($comments === false) {
            throw new \Exception("Ce commentaire n'existe pas");
        }
        return $comments;
    }

    /**
     * Récupère tous les commentaire organisé par ID
     * @param $post_id
     * @return array
     */
    public function findAllById($post_id)
    {
        $comments  = $this->query("
         SELECT *
         FROM ".$this->table."
         WHERE post_id = :post_id
         ", ['post_id' => $post_id], true, false);
        $comments_by_id = [];
        foreach ($comments as $comment) {
            $comments_by_id[$comment->id] = $comment;
        }
        return $comments_by_id;
    }

    /**
     * Permet de récupérer les commentaires avec les enfants
     * @param $post_id
     * @param bool $unset_children Doit-t-on supprimer les commentaire qui sont des enfants des résultats ?
     * @return array
     */
    public function findAllWithChildren($post_id, $unset_children = true)
    {
        // On a besoin de 2 variables
        // comments_by_id ne sera jamais modifié alors que comments
        $comments = $comments_by_id = $this->findAllById($post_id);
        foreach ($comments as $id => $comment) {
            if ($comment->parent_id != 0) {
                $comments_by_id[$comment->parent_id]->children[] = $comment;
                if ($unset_children) {
                    unset($comments[$id]);
                }
            }
        }
        return $comments;
    }

    public function getChildren($commentId){
        $comments  = $this->query("
         SELECT *
         FROM ".$this->table."
         WHERE parent_id = :commentId
         ", ['parent_id' => $commentId], true, false);
        return $comments;
    }

    /**
     * Permet de supprimer un commentaire en replaçant les enfants
     * @param $id
     */
    public function delete($id)
    {
        $comment = $this->find($id);
        $depth = (int) $comment->depth;
        $success = true;
        // On supprime le commentaire
        if(!$this->query('DELETE FROM comments WHERE id = :id', ['id' => $id])){
            $success = false;
        }
        // On monte tous les enfants
        if($depth === 1){// Si le commentaire est de niveau 1 il peut avoir des 'petits enfants' qu'ils faut remonter aussi
            $childs = $this->getChildren($comment->id);
            foreach ($childs as $child) {
                if(!$this->query('UPDATE comments SET depth = '.$child->depth.' WHERE parent_id = :parent_id', ['parent_id' => $child->id])){
                    $success = false;
                }
            }
        } 
        // Enfin on remonte les enfants de notre commentaire supprimé
        if(!$this->query('UPDATE comments SET parent_id = :parent_id, depth = '.$depth.' WHERE parent_id = :comment_id', ['comment_id' => $comment->id, 'parent_id' => $comment->parent_id])){
            $success = false;
        }
        return $success;
    }


    /**
     * Permet de supprimer un commentaire et ces enfants
     * @param $id
     * @return int
     */
    public function deleteWithChildren($id)
    {
        // On récupère le commentaire à supprimer
        $comment = $this->find($id);
        $comments = $this->findAllWithChildren($comment->post_id, false);
        $ids = $this->getChildrenIds($comments[$comment->id]);
        $ids[] = $comment->id;

        // On supprime le commentaire et ses enfants
        return $this->query('DELETE FROM comments WHERE id IN (' . implode(',', $ids) . ')');
    }

    /**
     * Get all chidren ids of a comment
     * @param $comment
     * @return array
     */
    private function getChildrenIds($comment)
    {
        $ids = [];
        foreach ($comment->children as $child) {
            $ids[] = $child->id;
            if (isset($child->children)) {
                $ids = array_merge($ids, $this->getChildrenIds($child));
            }
        }
        return $ids;
    }

    public function new(){
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;
        $depth = 0;

        if ($parent_id != 0) {
        $comment = $this->query('SELECT id, depth FROM comments WHERE id = ?', [$parent_id], true, true);
        if($comment === false){
            throw new Exception('Ce parent n\'existe pas');
        } 
        $depth = $comment->depth + 1;
        }

        if($depth > 3){
            $message = 'Limite de profondeur atteinte pour ce commentaire';
        } else {
            $this->query('INSERT INTO comments SET pseudo = :pseudo, comment = :comment, parent_id = :parent_id, post_id = :post_id, depth = :depth', 
                [
                'pseudo' => $_POST['pseudo'],
                'comment' => $_POST['content'],
                'parent_id' => $parent_id,
                'post_id' => $_POST['post_id'],
                'depth' => $depth]);
            $message = 'Merci pour votre commentaire :)';
        }
    return $message;
    }

    public function update(int $id, array $datas){
        $set = "";
        $attributes = [
            'id' => $id,
        ];
        foreach ($datas as $key => $value) {
            $set .= "$key=:$key,";
            $attributes[$key] = $value;
        }
        $set = substr($set, 0, (strlen($set)-1));
        $statement = "UPDATE ".$this->table." SET ".$set." WHERE id = :id
        ";
        return $this->db->prepare($statement, $attributes);
    }


}