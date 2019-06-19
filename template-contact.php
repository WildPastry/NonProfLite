<?php
/**
 * contact template
 * Template Name: Contact
 * @package nonproflite
 */

// get thumbnail image
$defaultThumb = get_template_directory_uri() . '/assets/img/default-thumb.jpg';
$thumbnailImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- feature map -->
			<div class="container-fluid-feature">

				<!-- map -->
				<div class="fullImageWrap">
					<div id="map" class="map"></div>
				</div>

			</div> <!-- feature map -->

			<!-- posts and content -->
			<div class='container-fluid'>

				<!-- menu -->
				<?php get_template_part('inc/templates/menu'); ?>

				<!-- content -->
				<?php get_template_part('inc/templates/content'); ?>

				<!-- form outer-->
				<div class="row">
					<div class="col-12">
							<div class="contactWrap">
								<h2>Get in touch</h2>

								<!-- form inner -->
								<form action="#" class="contactForm">
									<div class="row">
										<div class="col-6"><input type="text" class="contactInput" placeholder="Name" required="required"></div>
										<div class="col-6"><input type="email" class="contactInput" placeholder="Email" required="required"></div>
										<div class="col-12"><input type="phone" class="contactInput" placeholder="Mobile" required="required"></div>
										<div class="col-12"><input type="text" class="contactInput" placeholder="Subject"></div>
										<div class="col-12"><textarea class="contactInput contactText" placeholder="Message" required="required"></textarea></div>
										<button class="button contactButton">Submit</button>
									</div> <!-- row -->
								</form> <!-- form inner -->

							</div>
					</div>
				</div> <!-- form outer-->

				<!-- end posts while -->
			<?php endwhile;

	else : ?>

			<!-- no content -->
			<?php get_template_part('templates/content', 'none'); ?>

			<!-- end posts if -->
		<?php endif; ?>

	</div> <!-- container-fluid -->

</section> <!-- main content-area -->

<?php get_footer(); ?>