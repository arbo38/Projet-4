
function blogScript(){
	$('.suppressionArticle').on('click', function(event) {
		event.preventDefault();
		var premierBouton = this;
		var siblings = $(this).parent().siblings();
		console.log(siblings);
		var id = $(siblings[0]).html();
		//var href = "?delete=true&id=" + id;
		console.log(id);
		var test = $("<input type='submit' class='btn btn-danger' value='Confirmer' >");
		$(this).hide();
		$(this).after(test);
		setTimeout(function(){ 
			$(premierBouton).show();
			$(test).remove();
		}, 3000);
	});
	$('.suppressionCategorie').on('click', function(event) {
		event.preventDefault();
		var premierBouton = this;
		var siblings = $(this).parent().siblings();
		console.log(siblings);
		var id = $(siblings[0]).html();
		//var href = "?delete=true&id=" + id;
		console.log(id);
		var test = $("<input type='submit' class='btn btn-danger' value='Confirmer' >");
		$(this).hide();
		$(this).after(test);
		setTimeout(function(){ 
			$(premierBouton).show();
			$(test).remove();
		}, 3000);
	});
	tinymce.init({
    	selector: '.tinyMCE',
    	plugins : 'advlist autolink link image lists charmap print preview',
    	//toolbar: 'undo redo | styleselect | bold italic | link image'
  	});

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


  	// Affichage des commentaires par articles
  	 
  	var articleGroups = $(".comments_list");
  	articleGroups = Array.from(articleGroups);
  	$(articleGroups[0]).show();

    var select = $(".article_comment");
    select = Array.from(select);
    select.forEach(function(element){
		element.addEventListener('click', function(e){
				var articleSelector = $(this).data("article-id");
				$(".comments_list").hide();
				$("#" + articleSelector).show();
		    });
    });
}