<?php $aData = $this->aData; ?>

<div class="profiles--item profile" id="<?php echo strtolower($aData['profile_color']); ?>">
	<dt class="profile--term bg-<?php echo strtolower($aData['profile_color']); ?>"><span class="bg-<?php echo strtolower($aData['profile_color']); ?>-underline"><?php echo $aData['profile_color']; ?></span></dt>
	<dd class="profile--desc-container">
		<div class="profile--desc">
			<?php echo od_add_content_class($aData['profile_text'], 'profile-description'); ?>
		</div>

		<dl class="profile--sub-list">
			<div class="profile--sub-container">
				<!-- <dt class="profile--sub-term"><?php _e('Beleggingshorizon', 'od'); ?></dt>
				<dd class="profile--sub-desc"><?php echo $aData['profile_horizon']; ?></dd> -->

				<dt class="profile--sub-term"><?php _e('Verwacht jaarlijks rendement*', 'od'); ?></dt>
				<dd class="profile--sub-desc"><?php echo od_get_pretty_number($aData['profile_profit'], 2); ?> %</dd>
			</div>

			<div class="profile--sub-container">
				<!-- <dt class="profile--sub-term"><?php _e('Verwacht jaarlijks rendement*', 'od'); ?></dt>
				<dd class="profile--sub-desc"><?php echo od_get_pretty_number($aData['profile_profit'], 2); ?> %</dd> -->

				<dt class="profile--sub-term"><?php _e('Maximaal te verwachten verlies', 'od'); ?></dt>
				<dd class="profile--sub-desc"><?php echo $aData['profile_horizon']; ?></dd>
		</div>
		</dl>
	</dd>
</div>
