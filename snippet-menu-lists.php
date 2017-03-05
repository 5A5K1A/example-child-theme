<div class="menu--lists">
<?php foreach( array(3, 4, 5) as $iMenuID ) :
		$oMenu = wp_get_nav_menu_object( $iMenuID );
?>
	<div class="menu--lists-container">
		<p class="menu--list-title"><?php echo $oMenu->name; ?></p>
		<?php
			wp_nav_menu( array(
				'menu'              => $oMenu->slug,
				'theme_location'    => 'primary',
				'depth'             => 2,
				'container'         => '',
				'container_class'   => 'menu--item',
				'menu_class'        => 'menu--list',
				'fallback_cb'       => 'bootstrapnavwalker::fallback',
				'walker'            => new Nav_BootstrapWalker())
			);
		?>
	</div>
<?php endforeach; ?>
</div>
