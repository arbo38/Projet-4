
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

  	// #admin : Affichage des commentaires par articles

  	var commentGroups = $('.comments_list');
  	$(commentGroups).hide();
  	var commentGroupToShow = Array.from($('.article_comment'));
  	console.log(commentGroupToShow);
  	commentGroupToShow = $(commentGroupToShow[0]).data('article-id');
  	console.log(commentGroupToShow);
  	$('#' + commentGroupToShow).show();

	$("#comment_selector").change(function(){
    	$(commentGroups).hide();
    	var commentGroupSelector = $(this).children(":selected").data("article-id");
    	$("#" + commentGroupSelector).show();
	});

    // #admin : Affichage des articles via menu déroulant
  	 
  	var adminArticles = $(".admin-articles");
  	$(adminArticles).hide();
  	articleSelectors = Array.from($('.article_selector'));
  	var articleSelector = $(articleSelectors[0]).data("article-id");
	$("#" + articleSelector).show();
    $("#post_selector").change(function(){
    	$(adminArticles).hide();
    	var articleSelector = $(this).children(":selected").data("article-id");
    	$("#" + articleSelector).show();
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