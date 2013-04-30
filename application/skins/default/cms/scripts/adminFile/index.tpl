{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
{headScript()->appendFile($baseUrl . '/library/js/jquery/lightbox.js')}
{headScript()->appendFile($baseUrl . '/default/file/js/gallery.js')}
{headLink()->prependStylesheet($baseUrl . '/library/css/lightbox.css')}
{headLink()->prependStylesheet($baseUrl . '/default/file/css/index.css')}
<div class="content-box">
	<div class="content-box-header">
		<h3>{#Lista plików#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
		{$grid}
	</div>
</div>