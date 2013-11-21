<?php

class Default_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		Mail_Model_Dao::pushEmail('test-email', 'mariusz@milejko.pl');
	}

}
