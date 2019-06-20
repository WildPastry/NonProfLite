<?php
/**
 * content
 * @package nonproflite
 */

?>

<?php /* start singular if */ if (is_singular()) : ?>

	<!-- single post -->
	<div class="row">

		<!-- single post title -->
		<div class="col-12">
			<header>
				<h2><?php the_title(); ?></h2>
				<?php /* start post type if */ if ('post' == get_post_type()) : ?>
					<div class="post-date"><?php the_date(); ?></div> <!-- post-date -->
				<?php /* end post type if */ endif; ?>
			</header>
		</div>

		<!-- single post content -->
		<div class="col-12">
			<article>
				<?php the_content(); ?>
			</article>
		</div>

	</div> <!-- row -->

<?php /* else */ else : ?>

	<!-- multiple posts -->
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		<div class="card">

			<!-- multiple post thumbnail -->
			<?php /* start thumbnail if */ if (has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('thumbnail', ['class' => 'card-img-top img-fluid', 'alt' => 'image from post']) ?>
			<?php /* end thumbnail if */ endif; ?>

			<!-- multiple post title -->
			<div class="card-body">
				<h4 class="card-title"><?php the_title(); ?></h4>

				<!-- multiple post content -->
				<?php the_excerpt(); ?>
			</div> <!-- card-body -->

			<div class="card-footer">
				<button class="button cardButton"><a href="<?php the_permalink(); ?>">View Post</a></button>
				<p class="card-text"><small class="text-muted">Posted at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
			</div> <!-- card-footer -->

		</div> <!-- card -->

	</div> <!-- multiple posts -->

<?php /* end singular if */ endif; ?>