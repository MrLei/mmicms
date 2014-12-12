<?php

class Default_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		News_Model_Dao::activeByUriQuery('test')
			->find();
	}

}
