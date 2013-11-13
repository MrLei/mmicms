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
 * Mmi/View/Helper/Panel.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Panel deweloperski
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_Panel extends Mmi_View_Helper_Abstract {

	/**
	 * Renderuje panel
	 * @return string
	 */
	public function __construct() {
		parent::__construct();
		$view = $this->view;
		$elapsed = round(Mmi_Profiler::elapsed(), 4) . 's';
		$memory = round(memory_get_peak_usage() / (1024 * 1024), 2) . 'MB';
		if ($this->view->getCache() === null || !$this->view->getCache()->isActive()) {
			$cacheInfo = '<span style="color: #f22;">no cache</span>';
		} else {
			$cacheInfo = '<span style="color: #99ff99;">cache on</span>';
		}
		$html = "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
		$exception = $view->_exceptionInfo;
		$html .= '<div id="MmiPanelBar" onclick="document.getElementById(\'MmiPanel\').style.display=\'block\'; window.scrollTo(0,document.getElementById(\'MmiPanel\').offsetTop);" style="';
		$html .= 'text-align: center; position: fixed; padding: 0 10px; margin: 0; line-height: 0; background: #000; border-radius: 5px 5px 0 0; font: bold 10px Arial!important; color: #fff; bottom: 0px; left: 45%; text-transform: none;">' . $elapsed . ', ' . $memory . ' - ' . $cacheInfo . '</div>';
		$html .= '<div id="MmiPanel" ondblclick="this.style.display=\'none\';" style="';
		if (null === $exception) {
			$html .= 'display: none; ';
		}
		$html .= 'position: relative; text-align: left; padding: 20px 10px 5px 10px; background: #000; color: #eee; font: normal 11px Monospace;">';
		if (null !== $exception) {
			$html .= '<h2 style="color: #bb0000; margin: 0px; font-size: 14px; text-transform: none;">' . $exception['message'] . '</h2>';
			$html .= '<p style="margin: 0px; padding: 0px 0px 10px 0px;">' . $exception['file'] . ' <strong>(' . $exception['line'] . ')</strong></p>';
			if (!is_null($exception['info'])) {
				$html .= '<pre>' . print_r($exception['info'], true) . '</pre><br />';
			}
		}
		$extensions = get_loaded_extensions();
		$classes = get_declared_classes();
		$constants = get_defined_constants();
		asort($classes);
		asort($extensions);
		asort($constants);
		$html .= '<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; padding: 0px; margin: 0px;"><tr><td style="vertical-align: top; padding-right: 5px;">';

		$html .= '<p style="margin: 0px;">Transfer:</p>';
		$html .= '<pre style="margin:  0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
		$html .= '<p style="margin: 0; padding: 0;">Time: <b>' . $elapsed . ' (' . $memory . ', ' . $cacheInfo . ')</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Connection: <b>' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . '</b> <---> <b>' . $_SERVER['REMOTE_ADDR'] . ':' . $_SERVER['REMOTE_PORT'] . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Browser: <b>' . substr((isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''), 0, 93) . '</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Server: <b>' . $_SERVER['SERVER_SOFTWARE'] . ' + PHP ' . phpversion() . ' (' . php_sapi_name() . ', ' . php_uname('s') . ' ' . php_uname('m') . ': ' . php_uname('n') . ')</b></p>';
		$html .= '<p style="margin: 0; padding: 0;">Path: <b>' . $_SERVER['SCRIPT_FILENAME'] . '</b></p>';
		$html .= '</pre>';

		$html .= '<p style="margin: 0px;">Configuration:</p>';
		$html .= '<pre style="margin:  0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
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
		$html .= '<pre style="white-space: normal; word-wrap: break-word; margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
		if (Mmi_Db_Profiler::count() > 0) {
			foreach (Mmi_Db_Profiler::get() as $query) {
				$i++;
				$color = $query['percent'] * 15;
				$color = ($color + 80) > 255 ? 255 : $color + 80;
				$color = dechex($color);
				$color = $color . '9933';
				$html .= $i . '. (<strong style="color: #' .$color. ';">' . round($query['elapsed'], 4) . 's</strong>) - ' . $this->colorify($query['name']) . '<br />';
			}
		} else {
			$html .= 'No SQL queries.';
		}
		$html .= '</pre>';

		$html .= '<p style="margin: 0px;">PHP Profiler: </p><pre style="margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
		$profilerData = Mmi_Profiler::get();
		$percentSum = 0;
		foreach ($profilerData as $event) {
			$percentSum += $event['percent'];
			$color = $event['percent'] * 15;
			$color = ($color + 80) > 255 ? 255 : $color + 80;
			$color = dechex($color);
			$color = $color . $color . $color;
			$html .= '<div style="color: #' . $color . '"><div style="float: left; width: 500px;">' . $event['name'] . '</div><div style="float: left; width: 60px;"><b>' . round($event['elapsed'], 4) . 's</b></div><div style="float: left; width: 60px;"><b>' . round($event['percent'], 2) . '%</b></div><div style="float: left;"><b>' . round($percentSum, 2) . '%</b></div></div><div style="clear: both"></div>';
		}
		$html .= '</pre>';
		$html .= '<p style="margin: 0px;">Alternative PHP Cache:</p>';
		$html .= '<pre style="margin:  0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
		if (function_exists('apc_cache_info') && function_exists('apc_sma_info')) {
			$apcCache = apc_cache_info();
			$apcSma = apc_sma_info();
			if (is_array($apcCache) && !empty($apcCache)) {
				$html .= '<p style="margin: 0; padding: 0;">Uptime / ratio: <b>' . round((microtime(true) - $apcCache['start_time']) / 3600 / 24, 2) . ' days / ' . round(100 * ($apcCache['num_hits'] / ($apcCache['num_hits'] + $apcCache['num_misses'])), 2) . ' %</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Hits / misses: <b>' . $apcCache['num_hits'] . ' / ' . $apcCache['num_misses'] . '</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Present entries / inserts: <b>' . $apcCache['num_entries'] . ' / ' . $apcCache['num_inserts'] . '</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Memory used / available: <b>' . round(($apcCache['mem_size'] / 1048576), 2) . ' MB / ' . round(($apcSma['avail_mem'] / 1048576), 2) . ' MB</b></p>';
				$html .= '<p style="margin: 0; padding: 0;">Storage type / segments: <b>' . $apcCache['memory_type'] . '(' . $apcCache['locking_type'] . ')' . ' / ' . $apcSma['num_seg'] . '</b></p>';
			} else {
				$html .= '<span style="color: #ff0000; font-weight: bold; font-size: 14px;">APC installed, but not enabled. <br />Execution not optimal.</span>';
			}
		} else {
			$html .= '<span style="color: #ff0000; font-weight: bold; font-size: 14px;">No APC installed, or not in current version. <br />Execution not optimal.</span>';
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
			$html .= '<p style="margin: 0px;">Request Variables: </p><pre style="margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">' . $this->colorify(print_r(Mmi_Controller_Front::getInstance()->getRequest()->toArray(), true)) . '</pre>';
			$html .= '<p style="margin: 0px;">View Variables: </p><pre style="overflow-x: auto; max-width: 1000px; margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666; ">' . $this->colorify(print_r($viewVars, true)) . '</pre>';
		}
		if (isset($_COOKIE) && count($_COOKIE) > 0) {
			$html .= '<p style="margin: 0px;">Cookie Variables: </p><pre style="margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">' . $this->colorify(print_r($_COOKIE, true)) . '</pre>';
		}
		if (isset($_SESSION) && count($_SESSION) > 0) {
			$html .= '<p style="margin: 0px;">Session Variables: </p><pre style="margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">' . $this->colorify(print_r($_SESSION, true)) . '</pre>';
		}
		/*if (count(Mmi_Registry::getKeys()) > 0) {
			$html .= '<p style="margin: 0px;">Registry Variables: </p><pre style="margin: 0px 0px 10px 0px; color: #ddd; background: #222; padding: 3px; border: 1px solid #666;">';
			foreach (Mmi_Registry::getKeys() as $registryKey => $varValue) {
				if (is_object($varValue)) {
					$html .= $this->colorify('[' . $registryKey . '] => Object { ' . get_class($varValue) . ' }') . '<br />';
				} else {
					$html .= $this->colorify(print_r(Mmi_Registry::get($registryKey), true));
				}
			}
			$html .= '</pre>';
		}*/

		$html .= '</td></tr><tr><td colspan="2">';

		$exHtml = '<table style="color: #ddd; background: #222; padding: 3px; border: 1px solid #666;" width="100%"><tr><td style="vertical-align: top;">';
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

		$exHtml = '<table style="color: #ddd; background: #222; padding: 3px; border: 1px solid #666;" width="100%"><tr><td style="vertical-align: top;">';
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
		echo $html;
	}

	/**
	 * Koloruje składnie
	 * @param string $text kod
	 * @return string html
	 */
	public function colorify($text) {
		$text = preg_replace('/\[([a-zA-Z]+)\]/', '[<span style="color: #fff; font-weight: bold;">${1}</span>]', $text);
		$text = preg_replace('/\{([a-zA-Z_ ]+)\}/', '{<span style="color: #fff; font-weight: bold;">${1}</span>}', $text);
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
			'<span style="color: #66ff66; font-weight: bold;">Array</span>',
			'<span style="color: #66ff66; font-weight: bold;">Object</span>',
			'<span style="color: #6666ff; font-weight: bold;">(</span>',
			'<span style="color: #6666ff; font-weight: bold;">)</span>',
			'<span style="color: #ff6666; font-weight: bold;">[</span>',
			'<span style="color: #ff6666; font-weight: bold;">]</span>',
			'<span style="color: #ff66ff; font-weight: bold;">{</span>',
			'<span style="color: #ff66ff; font-weight: bold;">}</span>',
			'<span style="color: #ffff66; font-weight: bold;">=></span>',
			'<span style="color: #ffff66; font-weight: bold;"> = </span>',
			'<span style="color: #ff6666; font-weight: bold;">`</span>',
			'<span style="color: #fff; font-weight: bold;">DESCRIBE</span>',
			'<span style="color: #fff; font-weight: bold;">SELECT</span>',
			'<span style="color: #fff; font-weight: bold;">UPDATE</span>',
			'<span style="color: #fff; font-weight: bold;">FROM</span>',
			'<span style="color: #fff; font-weight: bold;">LIMIT</span>',
			'<span style="color: #fff; font-weight: bold;">GROUP BY</span>',
			'<span style="color: #fff; font-weight: bold;">ORDER BY</span>',
			'<span style="color: #fff; font-weight: bold;">ASC</span>',
			'<span style="color: #fff; font-weight: bold;">DESC</span>',
			'<span style="color: #fff; font-weight: bold;">AS</span>',
		);
		$text = str_replace($search, $replace, $text);
		return $text;
	}

}
