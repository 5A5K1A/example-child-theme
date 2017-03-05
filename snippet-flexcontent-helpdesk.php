<?php
	$aContact   = GetContactInfo();
	$aSocial    = GetSocialInfo();
	$iImageID   = get_field('helpdesk_image', 'options');
	$sImageSize = 'medium';
?>

<div class="home-brown">
	<section class="articles--section section helpdesk">
		<div class="helpdesk--text">
			<h2 class="helpdesk--title"><?php echo get_field('helpdesk_title', 'options'); ?></h2>
			<p class="helpdesk--intro"><?php echo get_field('helpdesk_text', 'options'); ?></p>

			<ul class="helpdesk--list-contact">
				<li class="helpdesk--item"><?php echo od_get_link( 'tel:'.$aContact['phone'], $aContact['phone'], array('class' => 'helpdesk--link helpdesk--tel', 'aria-label' => __('Bel ons op ', 'od').$aContact['phone']) ); ?></li>
				<li class="helpdesk--item"><?php echo od_get_link( 'mailto:'.$aContact['email'], $aContact['email'], array('class' => 'helpdesk--link helpdesk--mail', 'aria-label' => __('E-mail ons via ', 'od').$aContact['email']) ); ?></li>
				<li class="helpdesk--item">
					<address class="helpdesk--adress helpdesk--link ">
						<?php echo $aContact['address']; ?>
					</address>
				</li>
			</ul>
			<ul class="helpdesk--list-social">
				<?php if( !empty($aSocial['facebook']) ) : ?>
					<li class="helpdesk--item">
						<?php echo od_get_link( $aSocial['facebook'], od_strip_url($aSocial['facebook']), array('aria-label' => SITENAME.__(' op Facebook', 'od'), 'class' => 'helpdesk--link helpdesk--facebook') ); ?>
					</li>
				<?php endif; ?>

				<?php if( !empty($aSocial['twitter']) ) : ?>
					<li class="helpdesk--item">
						<?php echo od_get_link( $aSocial['twitter'], od_strip_url($aSocial['twitter']), array('aria-label' => SITENAME.__(' op Twitter', 'od'), 'class' => 'helpdesk--link helpdesk--twitter') ); ?>
					</li>
				<?php endif; ?>

				<?php if( !empty($aSocial['linkedin']) ) : ?>
					<li class="helpdesk--item">
						<?php echo od_get_link( $aSocial['linkedin'], od_strip_url($aSocial['linkedin']), array('aria-label' => SITENAME.__(' op LinkedIn', 'od'), 'class' => 'helpdesk--link helpdesk--linkedin') ); ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="helpdesk--img">
			<?php echo wp_get_attachment_image( $iImageID, $sImageSize, '', array('itemprop' => 'image') ); ?>
		</div>
	</section>
</div>
