<?php

/**
 * Obsługa crona
 *
 * Zadania mogą być zapoisane w formacie crontab
 * Przykładowe zapisy
 *
 * [* /5 * * * *] - wykonaj co pięć minut
 * [30 20 1 * *] - wykonaj o 20:30 każdego pierwszego dnia miesiąca
 * [* /30 * 2,5,7 * *] - wykonaj zawsze 2,5,i 7 każdego miesiąca co 30 minut
 */
class Cms_Model_Cron_Job {

	/**
	 * Pobiera zadania crona
	 */
	public static function run() {
		foreach (Cms_Model_Cron_Dao::activeQuery()
			->find() as $cron) {
			$logData = array();
			$logData['name'] = $cron->name;
			$logData['dateLastExecute'] = $cron->dateLastExecute;
			$logData['message'] = $cron->name;
			if (!self::_getToExecute($cron)) {
				continue;
			}
			$output = '';
			try {
				$start = microtime(true);
				$actionHelper = new Mmi_Controller_Action_Helper_Action();
				$output = $actionHelper->action($cron->module, $cron->controller, $cron->action, array(), true);
				$logData['time'] = round(microtime(true) - $start, 4) . 's';
				if ($output) {
					$logData['message'] = $cron->name . ': ' . $output;
				}
			} catch (Exception $e) {
				$logData['message'] = $e->__toString();
				Cms_Model_Log_Dao::add('Cron exception', $logData);
			}
			//Zmień datę ostatniego wywołania
			$cron->dateLastExecute = date('Y-m-d H:i:s');
			$cron->save();
			if (!$output) {
				continue;
			}
			Cms_Model_Log_Dao::add('Cron done', $logData);
		}
	}

	/**
	 * Sprawdza czy dane zadanie jest do wykonania
	 * @param Cms_Model_Cron_Record $record
	 */
	protected static function _getToExecute($record) {
		return self::_valueMatch(date('i'), $record->minute) &&
			self::_valueMatch(date('H'), $record->hour) &&
			self::_valueMatch(date('d'), $record->dayOfMonth) &&
			self::_valueMatch(date('m'), $record->month) &&
			self::_valueMatch(date('N'), $record->dayOfWeek);
	}

	protected static function _valueMatch($current, $value) {
		//Wszystko
		if ($value == '*') {
			return true;
		}
		//Każda wartość podzielna przez
		if (false !== strpos($value, '/')) {
			if ($current % intval(ltrim($value, '*/ ')) == 0) {
				return true;
			}
		}
		//Lista wartości
		$values = explode(',', $value);
		foreach ($values as $val) {
			if (intval($val) == $val && $val == $current) {
				return true;
			}
		}
		return false;
	}

}
