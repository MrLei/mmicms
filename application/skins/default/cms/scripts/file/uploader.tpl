<div id="fileUpload">
	<span id="upload">{#wgraj#}</span>
	<form id="uploader" action="{url($ajaxParams)}" accept-encoding="utf-8" enctype="multipart/form-data" method="post">
		<div>
			<input id="file" name="file[]" type="file" multiple />
		</div>
	</form>
</div>
<div id="uploaderEdit">
	<form id="uploaderEditForm" action="" accept-encoding="utf-8" enctype="multipart/form-data" method="post">
		<div>
			<label>{#Tytuł#}:</label>
			<input id="editTitle" name="title" type="text" />
			<label>{#Źródło (link)#}:</label>
			<input id="editSource" name="source" type="text" />
			<label>{#Autor#}:</label>
			<input id="editAuthor" name="author" type="text" />
			<label>{#Opis#}:</label>
			<textarea id="editDescription" name="description"></textarea>
			<input id="editReset" name="reset" type="reset" value="{#Anuluj#}" />
			<input id="editSubmit" name="submit" type="submit" value="{#Zapisz#}" />
		</div>
	</form>
</div>
<div id="fileWidget">
	<div class="attachmentManage imageManage">
		<ul class="imageFiles" id="manageImage">
			{if $files && php_isset($files.image)}
			{foreach $files.image as $file}
			<li id="item-file-{$file->id}" class="image item">
				<img src="{thumb($file, 'scaley', '32')}" alt="" /><br />
				<a href="#" id="edit-file-{$file->id}-{$file->hash}" class="edit-file">{#edytuj#}</a> | 
				<a href="#" id="file-{$file->id}-{$file->hash}" title="{#Czy chcesz usunąć ten plik#}" class="remove-file confirm">{#usuń#}</a>
				<label for="file-sticky-{$file->id}-{$file->name}">{#przypnij#}</label>
				<input name="sticky" id="file-sticky-{$file->id}-{$file->name}" class="sticky" {if $file->sticky}checked="checked" {/if}type="radio" />
			</li>
			{/foreach}
			{/if}
		</ul>
		<div class="cl"></div>
	</div>
	<div class="attachmentManage">
		<ul class="otherFiles" id="manageOther">
			{if $files && php_isset($files.other)}
			{foreach $files.other as $file}
			<li id="item-file-{$file->id}" class="item">
				{$file->original|truncate:32}<br />
				<a href="#" id="edit-file-{$file->id}-{$file->hash}" class="edit-file">{#edytuj#}</a> | 
				<a href="#" id="file-{$file->id}-{$file->hash}" title="{#Czy chcesz usunąć ten plik#}" class="remove-file confirm">{#usuń#}</a>
			</li>
			{/foreach}
			{/if}
		</ul>
		<div class="cl"></div>
	</div>
</div>