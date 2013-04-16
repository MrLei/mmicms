<h1>{$article->title}</h1>
{$article->text}
{widget('cms', 'file', 'index', array('object' => 'navigation', 'objectId' => $article->id))}