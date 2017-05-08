<?php

namespace Core\Controller;

/**
     * Parent générique de tous les controllers, leur permet l'héritage de la fonction de rendu des vues et des fonctions génériques pour les erreurs 404 et 403
*/

class Controller{

	protected $viewPath;
	protected $template;

	/**
     * Intègre une view dans un template en y injectant des variables
     * @param view $view : la vue à afficher
     * @param array $variables : les variables a passer à la vue
     * @return  Un "require" de la page a afficher : template + view
     */

	protected function render($view, $variables = []){
		ob_start();
		extract($variables);
		$view = $this->viewPath . str_replace('.', '/', $view) . '.php';
		require($view);
		$content = ob_get_clean();
		require($this->viewPath . 'templates/' . $this->template . '.php');
	}

	/**
     * Fonction générique d'affichage en cas d'erreur 404
     */

	public function notFound(){
		header("HTTP/1.0 404 Not Found");
		die('Page Introuvable');
	}

	/**
     * Fonction générique d'affichage en cas d'acces interdit
     */

	public function forbidden(){
		header("HTTP/1.0 403 Forbidden");
		die('Acces Interdit');
	}
}