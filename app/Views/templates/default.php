<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= App::getInstance()->getTitle(); ?></title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <header>

    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">
          <strong>Jean Forteroche - <small>Ecrivain</small></strong>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil</a>
            </li>
           <?php  
            $categories = App::getInstance()->getTable('category')->getAll();
            $html = "<li class='nav-item dropdown btn-group'>
            <a class='nav-link dropdown-toggle' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Categories</a>
            <div class='dropdown-menu dropdown' aria-labelledby='dropdownMenu1'>";
            foreach ($categories as $category) {
              $html .= "<a class='dropdown-item' href='".$category->getURL()."'>".$category->title."</a>";
            }
            $html .= "</div></li>";
            echo $html;
            ?>
            <li class="nav-item">
             <a class="nav-link"href="index.php?page=login">Espace Membre</a>
           </li>
            <?php
            if(isset($_SESSION['auth'])){
              if($_SESSION['auth']){
                echo " <li class='nav-item'>
            <a class='nav-link' href='?page=logout'>Déconnection</a>
          </li>";
              }
            }
           ?>
        </ul>
        <form class="form-inline waves-effect waves-light">
          <input class="form-control" type="text" placeholder="Recherche">
        </form>
      </div>
    </div>
  </nav>
  <!--/.Navbar-->

</header>

<main>

  <!--Main layout-->
  <div class="container">
    <?php if(!empty($message)): ?>
      <div class='temp alert alert-<?= $message["type"] ?>'>
        <?= $message['message'] ?>
      </div> <!-- div.alert alert-success -->
    <?php endif; ?>
    <?= $content; ?>
  </div>
  <!--/.Main layout-->

</main>

<!--Footer-->
<footer class="page-footer center-on-small-only">

  <!--Footer Links-->
  <div class="container-fluid">
    <div class="row">

      <!--First column-->
      <div class="col-md-3 offset-lg-1 hidden-lg-down">
        <h5 class="title">A propos de Jean Forteroche</h5>
        <p>Jean Forteroche est un écrivain français né en 1974
          dans une petite ville rhodanienne dans le Beaujolais.</p>

          <p>Il travaille actuellement sur son prochain roman, "Billet simple pour l'Alaska". Il souhaite innover et le publier par épisode en ligne sur son propre site.</p>
        </div>
        <!--/.First column-->

        <hr class="hidden-md-up">

        <!--Second column-->
        <div class="col-lg-2 col-md-4 offset-lg-1">
          <h5 class="title">Sites Partenaires</h5>
          <ul>
            <li><a href="#!">Terminus Development</a></li>
            <li><a href="#!">Openclassrooms</a></li>
            <li><a href="#!">Alalettre</a></li>
            <li><a href="#!">De-plume-en-plume</a></li>
          </ul>
        </div>
        <!--/.Second column-->

        <hr class="hidden-md-up">

        <!--Third column-->
        <div class="col-lg-2 col-md-4">
          <h5 class="title">Me suivre sur les réseaux</h5>
          <ul>
            <li><a href="#!">Facebook</a></li>
            <li><a href="#!">Twitter</a></li>
            <li><a href="#!">Google +</a></li>
            <li><a href="#!">Snapchat</a></li>
          </ul>
        </div>
        <!--/.Third column-->

        <hr class="hidden-md-up">

        <!--Fourth column-->
        <div class="col-lg-2 col-md-4">
          <h5 class="title">Mes coups de coeurs</h5>
          <ul>
            <li><a href="#!">Le Blog des Livres</a></li>
            <li><a href="#!">Wifeo</a></li>
            <li><a href="#!">Isaac Asimov</a></li>
            <li><a href="#!">Gallimard</a></li>
          </ul>
        </div>
        <!--/.Fourth column-->

      </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
      <div class="container-fluid">
        © 2017 Copyright: <a href="http://www.terminus-development.net"> BEAU Antony</a>

      </div>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->
  <!--/.Footer-->


  <!-- SCRIPTS -->

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/tether.min.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom JavaScript -->
  <script type="text/javascript" src="js/blog.js"></script>
  <!-- TinyMCE Plugin -->
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
    new WOW().init();
  </script>
  <script type="text/javascript">
    $( document ).ready(function() {
      blogScript();
    });
  </script>
  
</body>

</html>
