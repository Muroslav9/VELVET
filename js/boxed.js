			$(window).load(function(){
				$('body').children().removeClass().addClass('container');
			    $('.navbar').removeClass('row navbar-inverse').addClass('navbar-inverse-boxed');
			    $('.navbar').children().removeClass('container');
			    $('.container .content').addClass('col-sm-12');
			    $('footer').addClass('col-sm-12');
				$('body').fadeIn(400);
			});
			$('a').click(function(){
				$('body').fadeOut(400);
			})
