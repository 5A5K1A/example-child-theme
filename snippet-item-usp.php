<?php $aData = $this->aData; ?>

<li class="usps--item usp usp-<?php echo $this->iSlide ?>">
  <div class="usp--top">
    <span class="usp--numb"><?php echo $this->iSlide; ?></span>
    <p class="usp--text"><?php echo $aData['usp_text']; ?></p>
  </div>

  <?php Template::Render( '/dist/img/usp/' . $this->iSlide ); ?>

  <div class="usp--bottom">
    <p class="usp--subtext"><?php echo $aData['action_text']; ?></p>
    <?php echo od_get_link( $aData['button_url'], $aData['button_text'], array('class' => 'single-link--center usp--link') ); ?>
  </div>
</li>
