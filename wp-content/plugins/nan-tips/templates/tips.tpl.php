<div class="tip-container">
	<div class="tip-container__wrap">
		<div class="container">
			<h3 class="section-title"><?php print $this->data['heading'] ?></h3>
			<?php if($this->data['subheading'] != ''): ?>
				<span class="section-label"><?php print $this->data['subheading'] ?></span>
			<?php endif; ?>
			<p class="tip"><?php print $this->data['tip'] ?></p>
			<a class="btn is-reverse" href="<?php print $this->data['listing_link'] ?>" target="_self">
				<span>
					<span class="btn__text">View all tips</span>
				</span>
			</a>
		</div>
	</div>
</div>