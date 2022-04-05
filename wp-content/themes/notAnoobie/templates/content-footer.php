</div>
<footer class="footer">
	<div class="container">
		<div class="footer-img">
			<div class="footer-img_wrap">
				<?php print $data->footer_top ?>
			</div>
		</div>
		<div class="footer-text">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="footer-text_links">
						<?php print $data->legal_navigation ?>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<?php print $data->copyright ?>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="mobile-nav mobile-only">
	<?php print $data->mobile_main_navigation ?>
</div>
<div class="scrollToTop-wrapper">
	<button type="button" class="scrollToTop"><i class="icon icon-arrow-top"></i><span>Top</span></button>
</div>
<input type="hidden" id="push_frequency" value="<?php print $data->push_frequency ?>">