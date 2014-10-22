<?php

class Stat_Model_Dao extends Mmi_Dao {

	public static $_tableName = 'stat';

	public static function hit($object, $objectId = null) {
		$stat = new Stat_Model_Record();
		$stat->object = $object;
		$stat->objectId = is_numeric($objectId) ? intval($objectId) : null;
		$stat->dateTime = date('Y-m-d H:i:s');
		return $stat->save();
	}

	public static function agregate() {
		$start = microtime(true);
		$processed = 0;
		$q = self::newQuery()
			->limit(10000);
		foreach (self::find($q) as $item) {
			$processed++;
			$dateTime = explode(' ', $item->dateTime);
			$date = explode('-', $dateTime[0]);
			$time = explode(':', $dateTime[1]);
			$dateTime = strtotime($item->dateTime);
			$objectId = $item->objectId;
			if (!$item->objectId) {
				$objectId = null;
			}
			//godziny ogólnie - obiekty z id
			self::_push($item->object, $objectId, $time[0], null, null, null);
			//godziny ogólnie - same obiekty
			if ($objectId !== null) {
				self::_push($item->object, null, $time[0], null, null, null);
			}
			//godziny ogólnie w roku/miesiącu - same obiekty
			self::_push($item->object, null, $time[0], null, $date[1], $date[0]);

			//dni w dokładnej dacie - obiekty z id
			self::_push($item->object, $objectId, null, $date[2], $date[1], $date[0]);
			//dni w dokładnej dacie - osame obiekty
			if ($objectId !== null) {
				self::_push($item->object, null, null, $date[2], $date[1], $date[0]);
			}

			//miesiące w dokładnej dacie - obiekty z id
			self::_push($item->object, $objectId, null, null, $date[1], $date[0]);
			//miesiące w dokładnej dacie - same obiekty
			if ($objectId !== null) {
				self::_push($item->object, null, null, null, $date[1], $date[0]);
			}
			//lata - obiekty z id
			self::_push($item->object, $objectId, null, null, null, $date[0]);
			//lata - same obiekty
			if ($objectId !== null) {
				self::_push($item->object, null, null, null, null, $date[0]);
			}
			$item->delete();
		}
		$time = microtime(true) - $start;
		return array($processed, $time);
	}

	protected static function _push($object, $objectId, $hour, $day, $month, $year) {
		$q = self::newQuery()
				->where('object')->equals($object)
				->andField('objectId')->equals($objectId)
				->andField('hour')->equals($hour)
				->andField('day')->equals($day)
				->andField('month')->equals($month)
				->andField('year')->equals($year);
		$o = Stat_Model_Date_Dao::findFirst($q);
		if ($o === null) {
			$o = new Stat_Model_Date_Record();
		}
		$o->count = intval($o->count) + 1;
		$o->object = $object;
		$o->objectId = $objectId;
		$o->hour = $hour;
		$o->day = $day;
		$o->month = $month;
		$o->year = $year;
		return $o->save();
	}

}
