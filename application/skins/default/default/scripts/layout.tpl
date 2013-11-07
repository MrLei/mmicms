<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>{navigation()->title()}</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="keywords" content="{navigation()->keywords()}" />
		<meta name="description" content="{navigation()->description()}" />
		{headLink()->appendStyleSheet($baseUrl . '/default/default/style.css')}
		{headLink()}
		{headScript()}
	</head>
	<body>
		<div id="wrapper">
			<div id="page">
				<div id="page-bgtop">
					<div id="page-bgbtm">
						<div id="content">
							{messenger()}
							{content()}
						</div>
						<div id="sidebar">
							<div id="logo">
								<h1><a href="{@module=default@}">{#MmiCMS#}</a></h1>
								<p><a href="{@module=default@}">{#simply create#}</a></p>
							</div>
							<div id="menu">
								{navigation()->setRoot(101)->menu()}
							</div>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<p>©2009-{php_date('Y')} Mariusz Miłejko, Powered by <a href="http://www.hqsoft.pl">MmiFramework</a>.</p>
		</div>
	</body>
</html>