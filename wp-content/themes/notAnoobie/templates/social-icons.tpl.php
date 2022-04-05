<div>
	<div class="img_wrap__text"><span>Join the discussion</span></div>
	<?php foreach($icons as $icon): ?>
		<div class="img_wrap__img">
			<a href="<?php print $icon['link'] ?>" class="social-link" title="<?php print $icon['icon_name'] ?>">
				<i class="icon <?php print $icon['icon'] ?>"></i>
			</a>
		</div>
	<?php endforeach; ?>
</div>