
function blogScript(){
	// Editeur WYSIWYG TinyMCE
	tinymce.init({
    	selector: '.tinyMCE',
    	plugins : 'advlist autolink link image lists charmap print preview',
    	//toolbar: 'undo redo | styleselect | bold italic | link image'
  	});

	// Gestion de la confirmation pour la suppression d'articles
	$('.suppressionArticle').on('click', function(event) {
		event.preventDefault();
		var premierBouton = this;
		var siblings = $(this).parent().siblings();
		console.log(siblings);
		var id = $(siblings[0]).html();
		//var href = "?delete=true&id=" + id;
		console.log(id);
		var test = $("<input type='submit' class='btn btn-danger btn-sm' value='Confirmer' >");
		$(this).hide();
		$(this).after(test);
		setTimeout(function(){ 
			$(premierBouton).show();
			$(test).remove();
		}, 3000);
	});

	// Gestion de la confirmation pour la suppression de catégories
	$('.suppressionCategorie').on('click', function(event) {
		event.preventDefault();
		var premierBouton = this;
		var siblings = $(this).parent().siblings();
		console.log(siblings);
		var id = $(siblings[0]).html();
		//var href = "?delete=true&id=" + id;
		console.log(id);
		var test = $("<input type='submit' class='btn btn-danger btn-sm' value='Confirmer' >");
		$(this).hide();
		$(this).after(test);
		setTimeout(function(){ 
			$(premierBouton).show();
			$(test).remove();
		}, 3000);
	});
	
	// Gestion du formulaire de commentaire
  	$('.reply').click(function(e){
        e.preventDefault();
        var $form = $('#form-comment');
        var $this = $(this);
        var parent_id = $this.data('id');
        var $comment = $('#comment-' + parent_id);

        $form.find('h4').text('Répondre à ce commentaire');
        $('#parent_id').val(parent_id);
        $comment.after($form);
    });

    // Gestion du signalement d'un commentaire
    /*
    var url = window.location.href;
    var signalLinks = $(".signal_link");
    signalLinks = Array.from(signalLinks);
    console.log(signalLinks);
    signalLinks.forEach(function(link){
    	var commentId = $(link).data('id');
    	var linkUrl = url + 'signal=' + commentId;
    	$(link).attr('href', linkUrl); 

    });
    console.log(url);
    */


  	// #admin : Affichage des commentaires par articles
  	 
  	var articleGroups = $(".article_comment");
  	articleGroups = Array.from(articleGroups);
  	var articleSelector = $(articleGroups[0]).data("article-id");
	$("#" + articleSelector).show();

    var select = $(".article_comment");
    select = Array.from(select);
    select.forEach(function(element){
		element.addEventListener('click', function(e){
				var articleSelector = $(this).data("article-id");
				$(".comments_list").hide();
				$("#" + articleSelector).show();
		    });
    });

    // #admin : Affichage des articles via menu déroulant
  	 
  	var adminArticles = $(".admin-articles");
  	$(adminArticles).hide();
  	articleSelectors = Array.from($('.article_selector'));
  	var articleSelector = $(articleSelectors[0]).data("article-id");
  	console.log(articleSelector);
	$("#" + articleSelector).show();

    var selectArticles = $(".article_selector");
    selectArticles = Array.from(selectArticles);
    selectArticles.forEach(function(element){
		element.addEventListener('click', function(e){
				var articleSelector = $(this).data("article-id");
				$(".admin-articles").hide();
				$("#" + articleSelector).show();
		    });
    });

    // Messages temporaires
    setTimeout(function(){ $('.temp').fadeOut() }, 1500);

    $(function() {
	   $(".nav-item").click(function() {
	      // remove classes from all
	      $(".nav-item").removeClass("active");
	      // add class to the one we clicked
	      $(this).addClass("active");
	   });
	});
}