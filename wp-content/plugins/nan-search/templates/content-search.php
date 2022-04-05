<main id="main" class="main">
	<div class="container">
		<article id="content" class="no-sidebar">
			<script>
				(function() {
					var cx = '<?php print $data->cx_id; ?>';
					var gcse = document.createElement('script');
					gcse.type = 'text/javascript';
					gcse.async = true;
					gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(gcse, s);
				})();
			</script>
			<gcse:searchresults-only></gcse:searchresults-only>
		</article>
	</div>
</main>