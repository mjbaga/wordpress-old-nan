<?php if(!empty($data)): ?>
	<div>
		<?php if ($label != ''): ?>
			<div class="img_wrap__text">
				<span><?php print $label ?></span>
			</div>
		<?php endif ?>
		<?php foreach($data as $partner): ?>
			<div class="img_wrap__img">
				<a href="<?php print $partner['link'] ?>" class="social-link" target="_blank">
					<img src="<?php print $partner['image'] ?>" alt="<?php print $partner['alt'] ?>">
				</a>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>