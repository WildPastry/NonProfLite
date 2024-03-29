<?php
/**
 * content-dog
 * @package nonproflite
 */

// get thumbnail image
$thumbImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

// form logic
if ($_POST) {
	$errors = array();
	if (wp_verify_nonce($_POST['_wpnonce'], 'wp_enquiery_form')) {

		if (!$_POST['enquiriesName']) {
			array_push($errors, 'Your name is required');
		}

		if (!$_POST['enquiriesEmail']) {
			array_push($errors, 'Your email is required');
		}

		if (empty($errors)) {
			$args = array(
				'post_title' => $_POST['enquiriesName'],
				'post_type' => 'enquiries',
				'meta_input' => array(
					'email' => $_POST['enquiriesEmail']
				)
			);
			wp_insert_post($args);
		}
	} else {
		array_push($errors, 'Something went wrong with submitting the form');
	}
}
?>

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

		<!-- single post content -->
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
			<article>
				<?php the_content(); ?>
			</article>
		</div>
		<!-- image -->
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
			<?php echo '<div class="thumbImg" style="background-image: url(' . $thumbImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>'; ?>
		</div>

	</div> <!-- row -->

<?php /* else */ else : ?>

	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
			<article>
				<?php the_content(); ?>
			</article>
		</div>

	</div>
<?php /* end thumbnail if */ endif; ?>

<!-- form errors -->
<?php /* start form if */ if ($_POST && !empty($errors)) : ?>
	<div class="row justify-content-center">
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
	<div class="row justify-content-center">
		<div class="col-12">
				<div class="alert alert-success">
					<p>Your request to adopt has been sent successfully</p>
				</div>
		</div>
	</div>

<?php else : ?>

	<!-- form outer-->
	<div class="adoptWrap">
		<!-- form inner -->
		<form class="adoptForm" action="<?php echo get_permalink(); ?>" method="post">
			<?php wp_nonce_field('wp_enquiery_form'); ?>
			<div class="row">
				<h4>Adoption Form</h4>
				<input required type="text" class="contactInput" placeholder="Name" name="enquiriesName" value="<?php echo $_POST['enquiriesName'] ?>">
				<input required type="email" class="contactInput" placeholder="Email" name="enquiriesEmail" value="">
				<input type="submit" name="" value="Request Adoption" class="button adoptButton">
			</div> <!-- row -->
		</form> <!-- form inner -->

	</div> <!-- form outer-->

<?php /* end form post if */ endif; ?>