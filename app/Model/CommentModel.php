<?php

namespace App\Model;

use \Core\Model\Model;

/**
     * Gère les accès à la BDD pour les commentaires
*/

class CommentModel extends Model {

    /**
     * Récupère tous les commentaires de tous les articles
     * @param  int $post : id du commentaire
     * @return array $commentsByposts : contient les commentaire récupérés par articles
     */

    public function getAllByPosts(array $posts){
        $commentsByposts = [];
        foreach ($posts as $post) {
            $key = $post->title . ' - ' . $post->id;
            $commentsByposts[$key] = $this->query("SELECT posts.id AS articleId, posts.title as articleTitle, comments.id as id, comments.comment as content, comments.pseudo as pseudo FROM `posts` LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = ".$post->id."
                ");
        }
        return $commentsByposts;
    }

    /**
     * Récupère les dernier commentaires
     * @param $number : nombre de commentaire souhaités
     * @return array : contient les commentaire récupérés
     */

    public function getLast(int $number)
    {
        // On récupère le commentaire à supprimer
        $comments = $this->query("
         SELECT comments.id as id, pseudo, comments.comment as content, posts.title as articleTitle, posts.id as post_id 
         FROM comments
         LEFT JOIN posts ON comments.post_id = posts.id
         ORDER BY id DESC
         LIMIT ".$number."
         ", false, true, false);

        if ($comments === false) {
            throw new \Exception("Ce commentaire n'existe pas");
        }
        return $comments;
    }

    /**
     * Récupère tous les commentaire organisé par ID de l'article
     * @param $post_id
     * @return array
     */
    public function getAllById($post_id)
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
    public function getAllWithChildren($post_id, $unset_children = true)
    {
        // On a besoin de 2 variables
        // comments_by_id ne sera jamais modifié alors que comments
        $comments = $comments_by_id = $this->getAllById($post_id);
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

    /**
     * Ajoute un commentaire à la bdd
     * @param obligation d'avoir data a cause de la class parente, null ici car données en POST
     * @return array $message : information sur le déroulement de l'opération
     */

    public function add($data = null){ // 
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;
        $depth = 0;

        if ($parent_id != 0) {
        $comment = $this->query('SELECT id, depth FROM comments WHERE id = ?', [$parent_id], true, true);
            if($comment === false){
                $message = ['type' => 'danger', 'message' => 'Une réponse doit avoir un message parrent.'];
            } else {
                $depth = $comment->depth + 1;
            } 
        }
        if($depth >= 3){
            $message = ['type' => 'warning', 'message' => 'Limite de profondeur atteinte pour ce commentaire'];
        } else {
            $this->query('INSERT INTO comments SET pseudo = :pseudo, comment = :comment, parent_id = :parent_id, post_id = :post_id, depth = :depth', 
                [
                'pseudo' =>  strip_tags($_POST['pseudo']),
                'comment' =>  strip_tags($_POST['content']),
                'parent_id' => $parent_id,
                'post_id' => $_POST['post_id'],
                'depth' => $depth]);
            $message = ['type' => 'success', 'message' => 'Merci pour votre commentaire'];
        }
    return $message;
    }

    /**
     * Permet de supprimer un commentaire en replaçant les enfants
     * @param $id
     */
    public function delete($id)
    {
        $comment = $this->get($id);
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
     * Supprime tous les commentaires liés à un article
     * @param int $id : id de l'article
     * @return bool : suppression réussie
     */

    public function deleteFromArticle($id)
    {
        return $this->query('DELETE FROM comments WHERE post_id = :id', ['id' => $id]);
    }

    /**
     * Supprime un commentaire et tous ses "enfants"
     * @param int $id : commentaire a supprimer
     * @return bool = suppression réussie
     */

    public function deleteWithChildren($id)
    {
        // On récupère le commentaire à supprimer
        $comment = $this->get($id);
        $comments = $this->getAllWithChildren($comment->post_id, false);
        $ids = $this->getChildrenIds($comments[$comment->id]);
        $ids[] = $comment->id;

        // On supprime le commentaire et ses enfants
        return $this->query('DELETE FROM comments WHERE id IN (' . implode(',', $ids) . ')');
    }

    /**
     * Récupère les id de tous les commentaire enfant d'un commentaire
     * @param $comment : le commantaire parent
     * @return array : contenant tous les ids des enfants
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

    /**
     * Récupère les commentaires enfant d'un commentaire
     * @param $comment : le commantaire parent
     * @return array : contenant tous les ids des enfants
     */

    private function getChildren($commentId){
        $comments  = $this->query("
         SELECT *
         FROM ".$this->table."
         WHERE parent_id = :commentId
         ", ['commentId' => $commentId], true, false);
        return $comments;
    }

    public function report($id){
        if($this->update($id, ['report' => '1'])){
            return ['type' => 'success', 'message' => 'Le commentaire a bien été signalé'];
        } else {
            return ['type' => 'warning', 'message' => 'Une erreur est survenue lors du signalement du commentaire'];
        } 
    }

    public function unReport($id){
        if($this->update($id, ['report' => '0'])){
            return ['type' => 'success', 'message' => 'Le commentaire n\'est plus listé comme signalé'];
        } else {
            return ['type' => 'warning', 'message' => 'Une erreur est survenue lors de la mise à jour du statut du commentaire.'];
        } 
    }

    public function getReportedComments(){
        $items  = $this->query("
            SELECT *
            FROM ".$this->table."
            WHERE report='1'
            ", null, true);
        return $items;
    }

    
}