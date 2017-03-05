<?php $aData = $this->aData; ?>

<a href="<?php echo $aData['product_page']; ?>" class="product-choices--item product">
  <div class="product--left">
    <?php Template::Render('snippet-item-product-' . $this->sType); ?>
  </div>
  <div class="product--right">
    <h3 class="product--title"><?php echo $aData['product_firstline']; ?></h3>
    <p class="product--name"><?php echo $aData['product_secondline']; ?></p>
    <p class="product--disc"><?php echo $aData['product_thirdline']; ?></p>
  </div>
</a>
