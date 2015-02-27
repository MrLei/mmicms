<?php

namespace Core\Controller;

class Index extends \Mmi\Controller\Action {

	public function indexAction() {
		\Mmi\Dao\Builder::buildFromTableName('tutorial');
	}

}
