<main id="main" class="main">
	<div class="banner">
		<div class="content">
			<div class="container">
				<div class="page-title"><?php print $this->data['title'] ?></div>
				<h1 class="page-text"><?php print $this->data['hero_heading'] ?></h1>
			</div>
		</div>
		<div class="banner-image">
			<div class="image-container">
				<?php print $this->data['hero_image'] ?>
			</div>
		</div>
	</div>
	<div data-api="/wp-json/tips/last_month" data-prevmonth="<?php print $this->data['prev_month'] ?>" data-prevyear="<?php print $this->data['prev_year'] ?>" class="tip-box">
		<div class="tip-box__wrap">
			<?php if(!empty($this->data['tips_this_month'])): ?>
				<?php foreach ($this->data['tips_this_month'] as $tip): ?>
					<div data-date="<?php print $tip['day'] . '/' . $tip['month'] . '/' . $tip['year'] ?>" class="tip-box__item" id="tip-<?php print $tip['post_id'] ?>">
						<div class="container">
							<div class="tip-date">
								<h1 class="tip-day"><?php print $tip['day'] ?></h1>
								<p class="tip-month"><?php print $tip['month'] ?></p>
							</div>
							<div class="tip-content">
								<div class="tip-content__text">
									<?php print $tip['tip'] ?>
								</div>
								<div class="tip-content__share">
									<div class="share-bar">
										<div class="share-bar__text">Share this tip:</div>
										<div class="social-icon">
											<div class="social-icon__item">
												<a href="#" class="social-icon__link addthis_button_facebook">
													<i class="icon icon-facebook"></i>
												</a>
												<a href="#" class="social-icon__link addthis_button_email">
													<i class="icon icon-envelope"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
		<a class="btn load-more" href="javascript:void(0)" target="_self"><span><span class="btn__text">View Last Month's Tips</span></span>
		</a>
		<script id="tipsList" type="text/x-dot-template">
			{{~ it:tip:index }}
			<div data-date="{{=tip.date}}" class="tip-box__item">
				<div class="container">
					<div class="tip-date">
						<h1 class="tip-day">{{=tip.day}}</h1>
						<p class="tip-month">{{=tip.month}}</p>
					</div>
					<div class="tip-content">
						<div class="tip-content__text">
							<p>{{=tip.tip}}</p>
						</div>
						<div class="tip-content__share">
							<div class="share-bar">
								<div class="share-bar__text">Share this tip:</div>
								<div class="social-icon">
									<div class="social-icon__item"><a href="javascript:void(0)" class="social-icon__link"><i class="icon icon-facebook"></i></a><a href="javascript:void(0)" class="social-icon__link"><i class="icon icon-envelope"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{~}}
		</script>
	</div>
	<?php if(empty($this->data['tips_this_month'])): ?>
		<div class="no-results">
			<div class="container">
				<h3>Sorry, no tips set for this month.</h3>
			</div>
		</div>
	<?php endif ?>
</main>