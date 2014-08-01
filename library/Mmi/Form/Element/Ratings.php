<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Form/Element/Ratings.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Janusz Gołębiewski <janusz@golebiewski.info.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu oceny w komentarzach
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Form_Element_Ratings extends Mmi_Form_Element_Abstract {
	
	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_Controller_Front::getInstance()->getView();
		$view->headScript()->appendScript("
			$(document).ready(function() {
				$('#voteStars').mousemove(function (e) {
					var percent = e.pageX - $(this).offset().left;
					$(this).children('p').width(percent);
					if (percent > 100) {
						percent = 100;
					}
					$('div.starsLabel > span').html(percent/20);
					$('#opinion_stars').val(percent);
				});
			});
		");
		$html = '<div class="vote"><div id="voteStars" class="stars">';
		$html .= '<p></p>';
		$html .= '</div></div>';
		$html .= '<input id="opinion_stars" ';
		$html .= 'type="hidden" '.$this->_getHtmlOptions().' />';
		return $html;
	}

}