	
	</div>
	
	<?php 
	$options = get_option('themezee_options');
	if ( isset($options['themeZee_general_footer']) and $options['themeZee_general_footer'] <> "" ) { ?>
		<div id="footer">
			<?php echo $options['themeZee_general_footer']; ?>
		</div>
	<?php } ?>

	<div class="clear"></div>
	<div id="footline"></div>
	
</div>

<div class="credit_link">
	<div class="credit_link"><?php themezee_credit_link(); ?></div>
	<div class="clear"></div>
</div>

	<?php wp_footer(); ?>
</body>
</html>