<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Controller/Response/Debugger.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Panel deweloperski
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Response
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Response_Debugger {
	
	public function __construct() {
		$response = Mmi_Controller_Front::getInstance()->getResponse();
		switch ($response->getType()) {
			case 'htm':
			case 'html':
			case 'shtml':
				if (!is_string($response->getContent())) {
					return;
				}
				if (strpos($response->getContent(), '</body>')) {
					$response->setContent(str_replace('</body>', $this->getHtml() . '</body>', $response->getContent()));
				} else {
					$response->appendContent($this->getHtml());
				}
				break;
			case 'json':
				try {
					if (!is_string($response->getContent())) {
						return;
					}
					if (strpos($response->getContent(), '}')) {
						$lastBracket = strrpos($response->getContent(), '}');
						$content = substr($response->getContent(), 0, $lastBracket) . ',"debugger":' . json_encode($this->getJsonArray()) . substr($response->getContent(), $lastBracket);
						$response->setContent($content);
					} else {
						$response->appendContent(json_encode($this->getJsonArray()));
					}

			
				} catch (Exception $e) {
					$response
						->setCodeError()
						->setContent(json_encode(array('status' => 500, 'error' => 'Mmi_Controller_Response_Debugger: JSON format mismatch', 'exception' => $e->getTraceAsString(), 'debugger' => $this->getJsonArray())));
				}
				break;
		}
	}

	public function getJsonArray() {
		$view = Mmi_Controller_Front::getInstance()->getView();
		$env = Mmi_Controller_Front::getInstance()->getEnvironment();
		$dbg = array();
		$dbg['elapsed'] = round(Mmi_Profiler::elapsed(), 4) . 's';
		$dbg['memory'] = round(memory_get_peak_usage() / (1024 * 1024), 2) . 'MB';
		return $dbg;
	}
	
	public function getHtml() {
		$preElem = '<pre style="min-width: 450px; margin: 0px 0px 10px 0px; color: #666; background: #eee; padding: 3px; border: 1px solid #666;">';
		$preElemBreak = '<pre style="white-space: normal; word-wrap: break-word; margin: 0px 0px 10px 0px; color: #666; background: #eee; padding: 3px; border: 1px solid #666;">';
		$view = Mmi_Controller_Front::getInstance()->getView();
		$env = Mmi_Controller_Front::getInstance()->getEnvironment();
		$elapsed = round(Mmi_Profiler::elapsed(), 4) . 's';
		$memory = round(memory_get_peak_usage() / (1024 * 1024), 2) . 'MB';
		if ($view->getCache() === null || !$view->getCache()->isActive()) {
			$cacheInfo = '<span style="color: #f22;">no cache</span>';
		} else {
			$cacheInfo = '<span style="color: #99ff99;">cache on</span>';
		}
		$html = "\n\n\n<!-- MMI DEBUGGER -->\n\n";
		$html .= '<style>div#MmiPanel pre, div#MmiPanel table, div#MmiPanel table tr, div#MmiPanel table td, div#MmiPanel div, div#MmiPanel p {font: normal 11px Monospace!important;}</style><div id="MmiPanelBar" onclick="document.getElementById(\'MmiPanel\').style.display=\'block\'; window.scrollTo(0,document.getElementById(\'MmiPanel\').offsetTop);" style="';
		$html .= 'text-align: center; position: fixed; padding: 0 10px; margin: 0; line-height: 0; background: #999; border-radius: 5px 5px 0 0; font: bold 10px Arial!important; color: #000; bottom: 0px; left: 45%; text-transform: none;">' . $elapsed . ', ' . $memory . ' - ' . $cacheInfo . '</div>';
		$html .= '<div id="MmiPanel" ondblclick="this.style.display=\'none\';" style="';
		/* @var $view->_exception Exception */
		if (null === $view->_exception) {
			$html .= 'display: none; ';
		}
		$html .= 'position: relative; text-align: left; padding: 20px 10px 5px 10px; background: #ccc; color: #000; font: normal 11px Monospace!important;">';
		if (null !== $view->_exception) {
			$html .= '<h2 style="color: #bb0000; margin: 0px; font-size: 14px; text-transform: none;">' . $view->_exception->getMessage() . '</h2>';
			$html .= '<p style="margin: 0px; padding: 0px 0px 10px 0px;">' . $view->_exception->getFile() . ' <strong>(' . $view->_exception->getLine() . ')</strong></p>';
			//$html .= '<pre>' . $view->_exception->getTraceAsString() . '</pre><br />';
		}
		$extensions = get_loaded_extensions();
		$classes = get_declared_classes();
		$constants = get_defined_constants();
		asort($classes);
		asort($extensions);
		asort($constants);
		$html .= '<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; padding: 0px; margin: 0px;"><tr><td style="vertical-align: top; padding-right: 5px;">';

		$html .= '<p style="margin: 0px;">Transfer:</p>';
		$html .= $preElemBreak;
		$html .= '<p style="margin: 0; padding: 0;">Time: <b>' . $elapsed . ' (' . $memory . ', ' . $cacheInfo . ')</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Connection: <b>' . $env->serverAddress . ':' . $env->serverPort . '</b> <---> <b>' . $env->remoteAddress . ':' . $env->remotePort . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Browser: <b>' . substr($env->httpUserAgent, 0, 93) . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Server: <b>' . $env->serverSoftware . ' + PHP ' . phpversion() . ' (' . php_sapi_name() . ', ' . php_uname('s') . ' ' . php_uname('m') . ': ' . php_uname('n') . ')</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Path: <b>' . $env->scriptFilename . '</b></p>';
		$html .= '</pre>';

		$html .= '<p style="margin: 0px;">Configuration:</p>';
		$html .= $preElem;
		$html .= '<p style="margin: 0; padding: 0;">Include path: <b>' . ini_get('include_path') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Memory limit: <b>' . ini_get('memory_limit') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Register globals: <b>' . ((ini_get('register_globals') == 1) ? 'yes' : 'no') . '</b></p>';
		$html .= '<p style="margin: 0 0 10px 0; padding: 0;">Magic quotes: <b>' . ((get_magic_quotes_gpc() == 1) ? 'yes' : 'no') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Short tags: <b>' . ((ini_get('short_open_tag') == 1) ? 'yes' : 'no') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Uploads allowed: <b>' . ((ini_get('file_uploads') == 1) ? 'yes' : 'no') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Upload maximal size: <b>' . ini_get('upload_max_filesize') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Upload directory: <b>' . ((ini_get('upload_tmp_dir')) ? ini_get('upload_tmp_dir') : 'system default') . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">POST maximal size: <b>' . ini_get('post_max_size') . '</b></p>';
		$html .= '</pre>';

		$html .= '<p style="margin: 0px;">SQL queries: <b>' . Mmi_Db_Profiler::count() . '</b>, elapsed time: <b>' . round(Mmi_Db_Profiler::elapsed(), 4) . 's </b></p>';
		$i = 0;
		$html .= $preElemBreak;
		if (Mmi_Db_Profiler::count() > 0) {
			foreach (Mmi_Db_Profiler::get() as $query) {
				$i++;
				$color = $query['percent'] * 15;
				$color = ($color > 255) ? 255 : $color;
				$color = dechex($color);
				$color = $color . '2222';
				$html .= $i . '. (<strong style="color: #' . $color . '!important;">' . round($query['elapsed'], 4) . 's</strong>) - ' . $this->_colorify($query['name']) . '<br />';
			}
		} else {
			$html .= 'No SQL queries.';
		}
		$html .= '</pre>';

		$html .= '<p style="margin: 0px;">PHP Profiler: </p>';
		$html .= $preElem;
		$profilerData = Mmi_Profiler::get();
		$percentSum = 0;
		foreach ($profilerData as $event) {
			$percentSum += $event['percent'];
			$color = $event['percent'] * 15;
			$color = ($color > 255) ? 255 : $color;
			$color = dechex($color);
			$color = $color . '2222';
			$html .= '<div style="color: #' . $color . '"><div style="float: left; min-width: 400px;">' . $event['name'] . '</div><div style="float: left; width: 60px;"><b>' . round($event['elapsed'], 4) . 's</b></div><div style="float: left; width: 60px;"><b>' . round($event['percent'], 2) . '%</b></div><div style="float: left;"><b>' . round($percentSum, 2) . '%</b></div></div><div style="clear: both"></div>';
		}
		$html .= '</pre>';
		$html .= '<p style="margin: 0px;">PHP precompiler</p>';
		$html .= $preElem;
		if (function_exists('opcache_get_configuration') && function_exists('opcache_get_status')) {
			$html .= '<p style="margin: 0; padding: 0;">Engine: <b>OPcache</b></p>';
			if (!ini_get('opcache.restrict_api')) {
				$opCache = opcache_get_status();
				if ($opCache['opcache_enabled']) {
					$html .= '<p style="margin: 0; padding: 0;">Uptime / ratio: <b>' . round((microtime(true) - $opCache['opcache_statistics']['start_time']) / 3600 / 24, 2) . '</b> days / <b>' . round($opCache['opcache_statistics']['opcache_hit_rate'], 2) . '%</b></p>';
					$html .= '<p style="margin: 0; padding: 0;">Hits / misses: <b>' . $opCache['opcache_statistics']['hits'] . '</b> / <b>' . $opCache['opcache_statistics']['misses'] . '</b></p>';
					$html .= '<p style="margin: 0; padding: 0;">Present entries / inserts: <b>' . $opCache['opcache_statistics']['num_cached_keys'] . '</b> / <b>' . $opCache['opcache_statistics']['max_cached_keys'] . '</b></p>';
					$html .= '<p style="margin: 0; padding: 0;">Memory used / available: <b>' . round($opCache['memory_usage']['used_memory'] / 1048576, 2) . '</b> / <b>' . round($opCache['memory_usage']['free_memory'] / 1048576, 2) . ' MB</b></p>';
				} else {
					$html .= '<span style="color: #ff0000; font-weight: bold; font-size: 14px;">OPcache installed, but not enabled <br />Execution not optimal.</span>';
				}
			} else {
				$html .= '<span style="color: #666; font-weight: bold; font-size: 14px;">OPcache API restricted by directive opcache.restrict_api</span>';
			}
		} elseif (function_exists('apc_cache_info') && function_exists('apc_sma_info')) {
			$apcCache = apc_cache_info();
			$apcSma = apc_sma_info();
			$html .= '<p style="margin: 0; padding: 0;">Engine: <b>APC</b></p>';
			if (is_array($apcCache) && !empty($apcCache) && isset($apcCache['start_time'])) {
				$html .= '<p style="margin: 0; padding: 0;">Uptime / ratio: <b>' . round((microtime(true) - $apcCache['start_time']) / 3600 / 24, 2) . ' days / ' . round(100 * ($apcCache['num_hits'] / ($apcCache['num_hits'] + $apcCache['num_misses'])), 2) . ' %</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Hits / misses: <b>' . $apcCache['num_hits'] . ' / ' . $apcCache['num_misses'] . '</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Present entries / inserts: <b>' . $apcCache['num_entries'] . ' / ' . $apcCache['num_inserts'] . '</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Memory used / available: <b>' . round(($apcCache['mem_size'] / 1048576), 2) . ' MB / ' . round(($apcSma['avail_mem'] / 1048576), 2) . ' MB</b></p>';
			} else {
				$html .= '<span style="color: #ff0000; font-weight: bold; font-size: 14px;">APC installed, but not enabled. <br />Execution not optimal.</span>';
			}
		} else {
			$html .= '<span style="color: #ff0000; font-weight: bold; font-size: 14px;">PHP precompiler (such as OPcache or APC) not found. <br />Execution not optimal.</span>';
		}
		$html .= '</pre>';

		$html .= '</td><td style="vertical-align: top; padding-left: 5px;">';

		if ($view !== null) {
			$viewVars = array();
			$vars = $view->getAllVariables();
			if (is_array($vars)) {
				foreach ($view->getAllVariables() as $varName => $varValue) {
					if (is_object($varValue)) {
						$viewVars[$varName] = 'Object { ' . get_class($varValue) . ' }';
					} elseif (is_array($varValue)) {
						$array = array();
						foreach ($varValue as $key => $value) {
							if (is_object($value)) {
								$array[$key] = 'Object { ' . get_class($value) . ' }';
							} else {
								$array[$key] = $value;
							}
						}
						$viewVars[$varName] = $array;
					} else {
						$viewVars[$varName] = $varValue;
					}
				}
			}
			$html .= '<p style="margin: 0px;">Request Variables: </p>';
			$html .= $preElem;
			$html .= $this->_colorify(print_r(Mmi_Controller_Front::getInstance()->getRequest()->toArray(), true)) . '</pre>';
			$html .= '<p style="margin: 0px;">View Variables: </p>';
			$html .= $preElem;
			$html .= $this->_colorify(print_r($viewVars, true)) . '</pre>';
		}
		if (isset($_COOKIE) && count($_COOKIE) > 0) {
			$html .= '<p style="margin: 0px;">Cookie Variables: </p>';
			$html .= $preElem;
			$html .= $this->_colorify(print_r($_COOKIE, true)) . '</pre>';
		}
		if (isset($_SESSION) && count($_SESSION) > 0) {
			$html .= '<p style="margin: 0px;">Session Variables: </p>';
			$html .= $preElem;
			$html .= $this->_colorify(print_r($_SESSION, true)) . '</pre>';
		}
		$html .= '</pre>';

		$html .= '</td></tr><tr><td colspan="2">';

		$exHtml = '<table style="margin: 0 0 10px 0; color: #000; background: #eee; padding: 3px; border: 1px solid #666;" width="100%"><tr><td style="vertical-align: top;">';
		$ei = 0;
		foreach ($classes as $ext) {
			if ($ei != 0 && $ei % 40 == 0) {
				$exHtml .= '</td><td style="vertical-align: top;">';
			}
			$ei++;
			$exHtml .= $ei . '. ' . $ext . '<br />';
		}
		$exHtml .= '</td></tr></table>';
		$html .= '<p style="margin: 0px">Declared classes:</p>' . $exHtml;

		$exHtml = '<table style="margin: 0 0 10px 0; color: #000; background: #eee; padding: 3px; border: 1px solid #666;" width="100%"><tr><td style="vertical-align: top;">';
		$ei = 0;
		foreach ($extensions as $ext) {
			if ($ei != 0 && $ei % 10 == 0) {
				$exHtml .= '</td><td style="vertical-align: top;">';
			}
			$ei++;
			$exHtml .= $ei . '. ' . $ext . '<br />';
		}
		$exHtml .= '</td></tr></table>';
		$html .= '<p style="margin: 0px">Loaded extensions:</p>' . $exHtml;
		$html .= '</div>';
		return $html;
	}

	/**
	 * Koloruje składnie
	 * @param string $text kod
	 * @return string html
	 */
	protected function _colorify($text) {
		$text = preg_replace('/\[([a-zA-Z]+)\]/', '[<span style="color: #000; font-weight: bold;">${1}</span>]', $text);
		$text = preg_replace('/\{([a-zA-Z_ ]+)\}/', '{<span style="color: #000; font-weight: bold;">${1}</span>}', $text);
		$search = array(
			'Array',
			'Object',
			'(',
			')',
			'[',
			']',
			'{',
			'}',
			'=>',
			' = ',
			'`',
			'DESCRIBE',
			'SELECT',
			'UPDATE',
			'FROM',
			'LIMIT',
			'GROUP BY',
			'ORDER BY',
			'ASC',
			'DESC',
			'AS',
		);
		$replace = array(
			'<span style="color: #22cc22; font-weight: bold;">Array</span>',
			'<span style="color: #22cc22; font-weight: bold;">Object</span>',
			'<span style="color: #2222cc; font-weight: bold;">(</span>',
			'<span style="color: #2222cc; font-weight: bold;">)</span>',
			'<span style="color: #cc2222; font-weight: bold;">[</span>',
			'<span style="color: #cc2222; font-weight: bold;">]</span>',
			'<span style="color: #006600; font-weight: bold;">{</span>',
			'<span style="color: #006600; font-weight: bold;">}</span>',
			'<span style="color: #000f66; font-weight: bold;">=></span>',
			'<span style="color: #000f66; font-weight: bold;"> = </span>',
			'<span style="color: #cc2222; font-weight: bold;">`</span>',
			'<span style="color: #000; font-weight: bold;">DESCRIBE</span>',
			'<span style="color: #000; font-weight: bold;">SELECT</span>',
			'<span style="color: #000; font-weight: bold;">UPDATE</span>',
			'<span style="color: #000; font-weight: bold;">FROM</span>',
			'<span style="color: #000; font-weight: bold;">LIMIT</span>',
			'<span style="color: #000; font-weight: bold;">GROUP BY</span>',
			'<span style="color: #000; font-weight: bold;">ORDER BY</span>',
			'<span style="color: #000; font-weight: bold;">ASC</span>',
			'<span style="color: #000; font-weight: bold;">DESC</span>',
			'<span style="color: #000; font-weight: bold;">AS</span>',
		);
		return str_replace($search, $replace, $text);
	}

}
