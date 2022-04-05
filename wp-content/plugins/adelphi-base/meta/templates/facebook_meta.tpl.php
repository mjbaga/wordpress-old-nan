<!-- og tags, used by Facebook also -->
<?php if( !empty( $data['image'] ) ): ?>
<meta property="og:image" content="<?php print $data['image']; ?>"/>
<?php endif; ?>
<meta property="og:title" content="<?php print $data['title']; ?>"/>
<meta property="og:description" content="<?php print $data['description']; ?>"/>
<meta property="og:url" content="<?php print $data['url']; ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php print $data['site_name']; ?>"/>