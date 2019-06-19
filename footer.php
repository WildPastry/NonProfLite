<?php
/**
 * footer
 * @package nonproflite
 */

// get site title
$blog_title = get_bloginfo('name');

?>

</div> <!-- master container -->

	<footer class="footer">
		<div class="container-fluid">
			<div class="footerWrap">
				<a target="_blank" href="<?php echo esc_url(__('https://mikeparker.co.nz/', 'nonproflite')); ?>">
					<?php printf(__('Theme by %s', 'nonproflite'), 'Mike Parker'); ?>
				</a>
				<p>Content &copy; <a href='https://www.chchbullbreedrescue.org.nz/' target='_blank'><?php echo $blog_title ?> <?php echo date('Y'); ?></a></p>
			</div>
		</div> <!-- container -->
	</footer> <!-- footer -->

<?php wp_footer(); ?>
</body>

</html>