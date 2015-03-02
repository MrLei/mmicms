<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Ratings extends ElementAbstract {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = \Mmi\Controller\Front::getInstance()->getView();
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
		$html .= 'type="hidden" ' . $this->_getHtmlOptions() . ' />';
		return $html;
	}

}
