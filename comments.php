<?php if (comments_open()) { ?>
	<div class="content">
					<div class="section-title-bottom-after-single"></div>
					<div class="border-circle"></div>
	<h3 class="comments"><?php comments_number('Comments', '1 Comment', '% Comments'); ?> on article "<?php the_title();?>"
	</h3>
					<div class="section-title-bottom-after-single"></div>
					<div class="border-circle"></div>
	</div>
    <?php if (get_comments_number() == 0) { ?>
        <div class="content">
    		<h3>Maybe you want leave a first reply?</h3>
    	</div>
    <?php } else { ?>
		<div class="content">
	    <ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'   		    => 'ul',
					'short_ping'		=> true,
					'avatar_size'		=> 54,
					'reverse_top_level' => true,
				) );
			?>
		</ol>
    </div>
	<?php } ?>
		<?php comment_form( array(	'fields' 		=> '<p class="comment-form-author">
										<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
										<input type="text" id="author" name="author" class="form-control" placeholder="Name" required/>
										</p>
										<p class="comment-form-Email">
										<label for="email">'. __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) .' </label>
										<input type="email" id="email" name="email" class="form-control" placeholder="Email" required/>
										</p>
										<p class="comment-form-url">
										<label for="url">' . __( 'Website' ) . '</label>
										<input type="text" id="url" name="url" class="form-control" placeholder="Website">
										</p>',
									'comment_field' => '<p class="comment-form-comment">
										<label for="comment">' . _x( 'Comment', 'noun' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
										<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" required></textarea>
										</p>',
									'comment_notes_after' => null,
		)); ?>
	<?php }  ?>

