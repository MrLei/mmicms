<?php

class Stat_Model_Date_Dao extends Mmi_Dao {

	public static $_tableName = 'stat_date';

	public static function findUniqueObjects() {
		$all = Stat_Model_Date_Query::factory()
			->whereHour()->equals(null)
			->andFieldDay()->equals(null)
			->andFieldMonth()->equals(null)
			->andFieldObjectId()->equals(null)
			->orderAscObject()
			->find();
		$objects = array();
		foreach ($all as $object) {
			if (!isset($objects[$object->object])) {
				$objects[$object->object] = $object->object;
			}
		}
		return $objects;
	}

	public static function avgHourly($object, $objectId, $year, $month) {
		$stats = self::_getRows($object, $objectId, $year, $month, null, true);
		$statArray = array();
		foreach ($stats as $stat) {
			$statArray[$stat->hour] = $stat->count;
		}
		$stats = array();
		for ($i = 0; $i <= 23; $i++) {
			$hour = $i;
			$count = 0;
			if (isset($statArray[$hour])) {
				$count = $statArray[$hour];
			}
			$stats[$hour] = $count;
		}
		return $stats;
	}

	public static function daily($object, $objectId, $year, $month) {
		$stats = self::_getRows($object, $objectId, $year, $month, true, null);
		$time = strtotime($year . '-' . $month . '01 00:00:00');
		$days = date('t', $time);
		$statArray = array();
		if ($month < 10) {
			$month = '0' . ltrim($month, '0');
		}
		foreach ($stats as $stat) {
			$day = $stat->day;
			if ($day < 10) {
				$day = '0' . ltrim($day, '0');
			}
			$statArray[$stat->year . '-' . $month . '-' . $day] = $stat->count;
		}
		$stats = array();
		for ($i = 1; $i <= $days; $i++) {
			$day = $i;
			if ($day < 10) {
				$day = '0' . ltrim($day, '0');
			}
			$count = 0;
			if (isset($statArray[$year . '-' . $month . '-' . $day])) {
				$count = $statArray[$year . '-' . $month . '-' . $day];
			}
			$stats[$year . '-' . $month . '-' . $day] = $count;
		}
		return $stats;
	}

	public static function toDate($object, $objectId, $year, $month, $day) {
		$now = strtotime($year . '-' . $month . '-' . $day);
		$prev = strtotime('-1 month', $now);

		$statsPrev = self::_getRows($object, $objectId, date('Y', $prev), date('m', $prev), true, null);
		$stats = self::_getRows($object, $objectId, date('Y', $now), date('m', $now), true, null);

		$raw = array();
		foreach ($statsPrev as $stat) {
			$raw[$stat->year . '-' . $stat->month . '-' . $stat->day] = $stat->count;
		}
		foreach ($stats as $stat) {
			$raw[$stat->year . '-' . $stat->month . '-' . $stat->day] = $stat->count;
		}
		$statArray = array();

		for ($i = 30; $i > -1; $i--) {
			$curTime = strtotime('-' . $i . ' day', $now);
			$count = 0;
			if (isset($raw[date('Y', $curTime) . '-' . ltrim(date('m', $curTime), '0') . '-' . ltrim(date('d', $curTime), '0')])) {
				$count = $raw[date('Y', $curTime) . '-' . ltrim(date('m', $curTime), '0') . '-' . ltrim(date('d', $curTime), '0')];
			}
			$statArray[date('m.d', $curTime)] = $count;
		}
		return $statArray;
	}

	public static function monthly($object, $objectId, $year) {
		$stats = self::_getRows($object, $objectId, $year, true, null, null);
		$statArray = array();
		foreach ($stats as $stat) {
			if ($stat->month < 10) {
				$stat->month = '0' . ltrim($stat->month, '0');
			}
			$statArray[$stat->year . '-' . $stat->month] = $stat->count;
		}
		$stats = array();
		for ($i = 1; $i <= 12; $i++) {
			$month = $i;
			if ($month < 10) {
				$month = '0' . ltrim($month, '0');
			}
			$count = 0;
			if (isset($statArray[$year . '-' . $month])) {
				$count = $statArray[$year . '-' . $month];
			}
			$stats[$year . '-' . $month] = $count;
		}
		return $stats;
	}

	public static function yearly($object, $objectId) {
		$stats = self::_getRows($object, $objectId, true, null, null, null);
		$statArray = array();
		foreach ($stats as $stat) {
			$statArray[$stat->year] = $stat->count;
		}
		return $statArray;
	}

	public static function flotCode($chartName, array $series, $type = 'lines', $points = false, $labels = true, $legendContainer = null, $extendHandleTooltip = false) {
		if ($points) {
			$points = 'true';
		} else {
			$points = 'false';
		}
		$html = '$(function () {';
		$html = trim($html, ', ') . ';';
		$min = 1000000000000;
		$max = -1000000000000;
		$tickSeries = array();
		$j = 0;
		foreach ($series as $chart) {
			$i = 0;
			$first = true;
			$html .= $chartName . '_' . str_replace('-', '_', $chart['object']) . '_' . $j . ' = [';
			foreach ($chart['data'] as $label => $count) {
				$i++;
				if ($count < $min) {
					$min = $count;
				}
				if ($count > $max) {
					$max = $count;
				}
				$html .= '[' . $i . ', ' . $count . '], ';
				$tickSeries[$j][] = $label;
			}
			$html = trim($html, ', ') . '];';
			$first = false;
			$j++;
		}
		foreach ($tickSeries as $key => $ticks) {
			$html .= $chartName . '_ticks_' . $key . ' = [';
			foreach ($ticks as $tick) {
				$html .= '\'' . $tick . '\',';
			}
			$html = trim($html, ',') . '];';
			if ($extendHandleTooltip) {
				$html .= '$(\'#' . $chartName . '\').bind(\'plothover\', function (event, pos, item) {extendHandleTooltip(event, pos, item, ' . $chartName . '_ticks_' . $key . ', ' . $key . ');});';
			} else {
				$html .= '$(\'#' . $chartName . '\').bind(\'plothover\', function (event, pos, item) {handleTooltip(event, pos, item, ' . $chartName . '_ticks_' . $key . ', ' . $key . ');});';
			}
		}

		$max = $max + 15 / 100 * $max;
		if ($min > 0) {
			$min = $min - 70 / 100 * $min;
		}
		$html .= 'var ' . $chartName . ' = $.plot($(\'#' . $chartName . '\'), [';
		$i = 0;
		foreach ($series as $chart) {
			$html .= '{data: ' . $chartName . '_' . str_replace('-', '_', $chart['object']) . '_' . $i . ', label: \'' . $chart['label'] . '\'}, ';
			$i++;
		}
		$html = trim($html, ', ') . '], ';
		$html .= '{
               series: {
                   ' . $type . ': { show: true },
                   points: { show: ' . $points . ' }
               },';
		if ($legendContainer == null) {
			$html .= 'legend: { margin: [0, 0], backgroundOpacity: 0 },';
		} else {
			$html .= 'legend: { margin: [0, 0], backgroundOpacity: 0, container: $("#' . $legendContainer . '") },';
		}
		$html .= 'grid: { hoverable: true, clickable: true },
               yaxis: { min: ' . $min . ', max: ' . $max . ' },
			   xaxis: {';
		$html .= 'ticks: [';
		$i = 0;
		if (isset($ticks)) {
			$div = round(count($ticks) * strlen($ticks[0]) / 60);
			if ($div < 1) {
				$div = 1;
			}
			if ($labels) {
				foreach ($tickSeries[0] as $tick) {
					$i++;
					if (($i - 1) % $div == 0) {
						$html .= '[' . $i . ', \'' . $tick . '\'], ';
					}
				}
			}
		}
		$html = trim($html, ', ') . ']';
		$html .= '}
			});';
		return $html . '});';
	}

	protected static function _getRows($object, $objectId, $year = null, $month = null, $day = null, $hour = null) {
		$q = Stat_Model_Date_Query::factory()
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId);

		self::_bindParam($q, 'year', $year);
		self::_bindParam($q, 'month', $month);
		self::_bindParam($q, 'day', $day);
		self::_bindParam($q, 'hour', $hour);

		return $q->orderAsc('day')
			->orderAsc('month')
			->orderAsc('year')
			->orderAsc('hour')
			->find();
	}

	protected static function _bindParam(Mmi_Dao_Query $q, $name, $value) {
		if ($value === true) {
			$q->andField($name)->notEquals(null);
			return;
		}
		$q->andField($name)->equals($value);
		return;
	}

}
