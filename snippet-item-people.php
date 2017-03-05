<?php
	$oData   = $this->oPerson->GetDataObject();
?>

<li class="people--item person">
	<a href="<?php $oData->permalink ?>">
		<figure class="person--container">
			<img class="person--img" src="<?php echo $oData->imageurl; ?>" alt="<?php echo $oData->fulllabel; ?>">
			<figcaption class="person--figcaption">
				<p class="person--title"><?php echo $oData->fulllabel ?></p>
				<p class="person--text"><?php echo $oData->intro; ?></p>
			</figcaption>
		</figure>
	</a>
</li>
