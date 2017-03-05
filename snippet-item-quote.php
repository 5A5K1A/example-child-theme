<?php $aData = get_fields($this->iQuoteID); ?>

<blockquote class="quotes--item">
	<p><?php echo $aData['quote_text']; ?></p>

<?php if( !empty($aData['quote_author']) ) : ?>
	<footer class="quote-author"><?php echo $aData['quote_author']; ?></footer>
<?php endif; ?>

</blockquote>
