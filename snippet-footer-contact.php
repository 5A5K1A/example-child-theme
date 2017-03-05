<?php
	$aContact = GetContactInfo();
?>
<div class="menu--lists-container">
	<p class="menu--list-title">Contact</p>
	<address class="menu--list">
		<p class="menu-item"><?php echo $aContact['address']; ?></p>
	</address>
	<ul class="menu--list">
		<li class="menu-item">
			<?php echo od_get_link( 'tel:'.$aContact['phone'], $aContact['phone'], array('aria-label' => __('Bel ons op ', 'od').$aContact['phone']) ); ?>
		</li>
		<li class="menu-item">
			<?php echo od_get_link( 'mailto:'.$aContact['email'], $aContact['email'], array('aria-label' => __('E-mail ons via ', 'od').$aContact['email']) ); ?>
		</li>
	</ul>
</div>
