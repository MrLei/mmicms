<?php

class Cms_Controller_Captcha extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->name) {
			return '';
		}
		$characters = array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','R','S','T','U','W','Z');
		$word = '';
		$numChars = count($characters)-1;
		for ($i = 0; $i < 5; $i++) {
			$word .= $characters[rand(0, $numChars)];
		}

		$img = imagecreatetruecolor(130, 50);

		$green = imagecolorallocate($img, 0x00, 0x77, 0x00);
		$gray = imagecolorallocate($img, 0xF5, 0xF5, 0xF5);
		$darkGray = imagecolorallocate($img, 0x99, 0x99, 0x99);
		$font = PUBLIC_PATH . '/default/cms/ttf/dejavu.ttf';

		imagefilledrectangle($img, 0, 0, 129, 49, $darkGray);
		imagefilledrectangle($img, 1, 1, 128, 48, $gray);

		$prevSpace = -5;
		$prevAngle = 0;

		for( $i = 0; $i<strlen($word); $i++ ) {
			if( $i%2 != 0 )	{
				$size = rand(32, 36);
				$height = rand(42, 46);
				$angle = rand(5, 15);
				$space = 25+$prevSpace;
			}	else {
				$size = rand(28, 32);
				$height = rand(39, 43);
				$angle = rand(-15, 5);
				$space = 13+$prevSpace;
			}
			$prevSpace = $space;
			$prevAngle = $angle;
			imagefttext($img, $size, $angle, $space, $height, $green, $font, $word[$i]);
		}

		$formSession = new Mmi_Session_Namespace('Mmi_Form');
		$name = 'captcha_' . $this->name;
		$formSession->$name = $word;

		$pastYear = date('Y')-1;
		$this->getResponse()
			->setHeader('Expires', 'Mon, 15 Dec ' . $pastYear . ' 01:00:00 GMT+0100')
			->setHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT')
			->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate')
			->setHeader('Cache-Control', 'post-check=0, pre-check=0', false)
			->setHeader('Pragma', 'no-cache')
			->setTypeJpeg();
		imagejpeg($img, NULL, 25);
		return '';
	}

}
