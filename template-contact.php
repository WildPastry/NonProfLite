<?php
/**
 * contact template
 * Template Name: Contact
 * @package nonproflite
 */

// form logic
get_template_part('inc/templates/form-logic');

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php /* start posts if */ if (have_posts()) :
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

				<!-- form errors -->
				<?php /* start form if */ if ($_POST && !empty($errors)) : ?>
					<div class="row">
						<div class="col-12">
							<div class="alert alert-danger">
								<ul class="text-center">
									<?php foreach ($errors as $singleError) : ?>
										<li><?php echo $singleError; ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php /* end form if */ endif; ?>

				<?php /* start form post if */ if ($_POST && empty($errors)) : ?>
					<div class="row">
						<div class="col-12">
							<div class="alert alert-success">
								<p>Your enquiry has been sent successfully</p>
							</div>
						</div>
					</div>

				<?php else : ?>

					<!-- form outer-->
					<div class="row">
						<div class="col-12">
							<div class="contactWrap">

								<!-- form inner -->
								<form class="contactForm" action="<?php echo get_permalink(); ?>" method="post">
									<?php wp_nonce_field('wp_enquiery_form'); ?>
									<div class="row">
										<div class="col-6"><input required type="text" class="contactInput" placeholder="Name" name="enquiriesName" value="<?php echo $_POST['enquiriesName'] ?>"></div>
										<div class="col-6"><input required type="email" class="contactInput" placeholder="Email" name="enquiriesEmail" value=""></div>
										<div class="col-12"><input required type="phone" class="contactInput" placeholder="Mobile"></div>
										<div class="col-12"><input required type="text" class="contactInput" placeholder="Subject"></div>
										<div class="col-12"><textarea required class="contactInput contactText" placeholder="Message" name="enquiriesMessage"></textarea></div>
										<input type="submit" name="" value="Send Enquiry" class="button contactButton">
									</div> <!-- row -->
								</form> <!-- form inner -->

							</div>
						</div>
					</div> <!-- form outer-->

				<?php /* end form post if */ endif; ?>

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