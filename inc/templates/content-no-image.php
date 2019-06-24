<?php
/**
 * content no image
 * @package nonproflite
 */

// get thumbnail image
$thumbImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

?>

<?php /* start singular if */ if (is_singular()) : ?>

	<!-- single post -->
	<div class="row justify-content-center">

		<!-- single post title -->
		<div class="col-12">
			<header>
				<h1><?php the_title(); ?></h1>
				<?php /* start post type if */ if ('post' == get_post_type()) : ?>
					<h3><?php the_date(); ?></h3> <!-- post-date -->
				<?php /* end post type if */ endif; ?>
			</header>
		</div>
	</div> <!-- row -->

	<div class="row justify-content-center">

		<!-- single post image -->
		<?php /* start thumbnail if */ if (has_post_thumbnail()) : ?>

		<div class="row justify-content-center">
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
				<article class="two-column">
					<?php the_content(); ?>
				</article>
			</div>

		</div>
	<?php /* end thumbnail if */ endif; ?>

<?php /* else */ else : ?>

	<!-- multiple posts -->
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
		<div class="card">

			<!-- multiple post thumbnail -->
			<?php /* start thumbnail if */ if (has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid', 'alt' => 'image from post']) ?>
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