	
	<?php themezee_footer_before(); // hook before #footer ?>
	<?php 
	$options = get_option('themezee_options');
	if ( isset($options['themeZee_general_footer']) and $options['themeZee_general_footer'] <> "" ) : ?>
		<div id="footer">
			<?php echo $options['themeZee_general_footer']; ?>
		</div>
	<?php endif; ?>
	<?php themezee_footer_after(); // hook after #footer ?>
	
	<div class="clear"></div>
	<div id="footline"></div>
	
</div><!-- end #wrapper -->
<?php themezee_wrapper_after(); // hook after #wrapper ?>

<div class="credit_link">
	<div class="credit_link"><?php themezee_credit_link(); ?></div>
	<div class="clear"></div>
</div>

<?php wp_footer(); ?>
</body>
</html>