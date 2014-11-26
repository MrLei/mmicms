<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DayName
 *
 * @author moczkowski
 */
class Mmi_Filter_DayName extends Mmi_Filter_Abstract {

	//put your code here
	private $dayOfWeekArray = array(
		'Monday' => 'poniedziałek',
		'Tuesday' => 'wtorek',
		'Wednesday' => 'środa',
		'Thursday' => 'czwartek',
		'Friday' => 'piątek',
		'Saturday' => 'sobota',
		'Sunday' => 'niedziela');

	public function filter($value) {
		$dateObject = new DateTime($value);
		return $this->dayOfWeekArray[$dateObject->format('l')];
	}

}
