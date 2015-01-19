{if $files && !php_empty($files)}
	<div class="attachments">
		{if php_isset($files.image)}
			{headScript()->prependFile($baseUrl . '/library/js/jquery/jquery.js')}
			{headScript()->appendFile($baseUrl . '/default/file/js/jquery/lightbox.js')}
			{headScript()->appendFile($baseUrl . '/default/file/js/gallery.js')}
			<ul class="imageFiles">
				{foreach $files.image as $file}
					<li>
						<a class="lightbox" title="{$file->title}" href="{thumb($file, 'scale', '600')}"><img src="{thumb($file, 'scaley', '80')}" alt="" /></a>
					</li>
				{/foreach}
			</ul>
			<div class="cl"></div>
		{/if}
		{if php_isset($files.other)}
			<div class="cl"></div>
			<ul class="otherFiles">
				{foreach $files.other as $file}
					<li>
						<a href="{$file}">{$file->original}</a>
					</li>
				{/foreach}
			</ul>
			<div class="cl"></div>
		{/if}
	</div>
{/if}