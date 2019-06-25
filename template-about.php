<?php
/**
 * about template
 * Template Name: About
 * @package nonproflite
 */

// get custom text
$customText = get_theme_mod('custom_about_headings_setting');
$customTextInfo = get_theme_mod('custom_info_headings_setting');
$customTextInfoPara = get_theme_mod('custom_info_headings_setting');
$defaultText = 'All News';
$defaultTextInfo = 'Pitbull Breed Information';
$defaultTextInfoPara = 'The Pit Bull Terrier is a companion and family dog breed. Originally bred to “bait” bulls, the breed evolved into farm dogs, and later moved into the house to become “nanny dogs” because they were so gentle around children.';

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- feature image -->
			<?php get_template_part('inc/templates/feature'); ?>

			<!-- posts and content -->
			<!-- <div class='container-fluid'> -->

			<!-- menu -->
			<?php get_template_part('inc/templates/menu'); ?>

			<!-- content -->
			<?php get_template_part('inc/templates/content-no-image'); ?>

			<!-- end posts while -->
		<?php endwhile;

else : ?>

		<!-- no content -->
		<?php get_template_part('templates/content', 'none'); ?>

		<!-- end posts if -->
	<?php endif; ?>

	<!-- </div>  -->
	<!-- posts and content -->

	<!-- feature section -->
	<div class="container-fluid-feature container-background">

		<!-- posts and content -->
		<div class='container-fluid'>

			<!-- information title -->
			<div class="row justify-content-center mt-3">
				<div class="col-10">
				<?php if ($customTextInfo == "") : echo '<h2>' . $defaultTextInfo . '</h2>';
				else :
					echo '<h2>' . $customTextInfo . '</h2>';
				endif;
				?>
				</div>
			</div> <!-- row -->

			<!-- post content -->
			<div class="row justify-content-center">

				<div class="col-10 text-center">
				<?php if ($customTextInfoPara == "") : echo '<h5>' . $defaultTextInfoPara . '</h5>';
				else :
					echo '<h5>' . $customTextInfoPara . '</h5>';
				endif;
				?>
				</div>

			</div> <!-- row -->

		</div> <!-- container-fluid -->

	</div> <!-- feature section -->

	<!-- posts and content -->
	<div class='container-fluid'>

		<!-- latest news -->
		<?php
		$args = array(
			'orderby' => 'date',
			'order' => 'ASC',
			'post_type' => 'post',
			'posts_per_page' => -1
		);
		$allNews = new WP_Query($args);
		?>

		<!-- latest news title -->
		<div class="row mt-3">
			<div class="col-12">
				<?php if ($customText == "") : echo '<h2>' . $defaultText . '</h2>';
				else :
					echo '<h2>' . $customText . '</h2>';
				endif;
				?>
			</div>
		</div> <!-- row -->

		<!-- post content -->
		<div class="row">

			<?php /* start news if */ if ($allNews->have_posts()) : ?>
				<?php /* start news count */ $newsNum = 1; ?>
				<?php /* start news while */ while ($allNews->have_posts()) : $allNews->the_post(); ?>
					<?php /* start news image if */ if (has_post_thumbnail()) : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
							<div class="card">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'alt' => 'image from dog post type']) ?>
								</a>
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">News posted at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* else */ else : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">News posted at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* end news image if */ endif; ?>
				<?php /* end news while */ endwhile; ?>
				<?php /* end news count */ $newsNum++; ?>
			<?php /* end news if */ endif; ?>

		</div> <!-- row -->

	</div> <!-- posts and content -->

</section> <!-- main content-area -->

<?php get_footer(); ?>