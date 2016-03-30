(function($){
			$(document).ready(function(){
				velvet_header();
				velvet_sidebar_footer();
				velvet_comment_form();
			})
				function velvet_header() {
			        var win	       = $(window),
			            header          = $('.navbar-inverse'),
			            elements        = $('.header'),
			            el_height       = $(elements).filter(':first').height(),
			            set_height      = function()
			            { 
			                var st = win.scrollTop(), newH = 0;
			                if(st < el_height/2)
			                {
			                    newH = el_height - st;
			                }
			                else
			                {
			                    newH = el_height/2;
			                }
			                elements.css({height: newH + 'px', lineHeight: newH + 'px'});
			            }
						win.scroll(set_height);
			            set_height();
			    }

	var 
	speed = 500,
	$scrollTop = $("<a/>")
	  .addClass('scrollTop')
	  .attr({href:'#', style:'display:none; z-index:9999; position:fixed;'})
	  .appendTo('body');		

	$scrollTop.click(function(e){
		e.preventDefault();

		$( 'html:not(:animated),body:not(:animated)' ).animate({ scrollTop: 0}, speed );
	});

	//появление
	function show_scrollTop(){
		( $(window).scrollTop() > 300 ) ? $scrollTop.fadeIn(600) : $scrollTop.fadeOut(600);
	}
	$(window).scroll( function(){ show_scrollTop(); } );
	show_scrollTop();

			    function velvet_sidebar_footer(){
			    	$('.ul-archives').children().addClass('col-lg-4 col-md-4 col-sm-4 col-xs-12');
			    }
			    function velvet_comment_form(){
			    	$('.form-submit input').first().remove();
			    	$('<input>').attr({
					    type: 'submit',
					    name: 'submit',
					    id:  'submit' 
					}).addClass('btn btn-primary').appendTo('.form-submit');
			    	$('<input>').attr({
					    type: 'reset',
					    name: 'reset'
					}).addClass('btn btn-default').appendTo('.form-submit');
			    }
// $('img').click(function(){
// 	$(this).animate({
//     width: "500px",
//     height: "300px",
//   }, 500 ).addClass('modal-content img-click');
// })
})(jQuery);