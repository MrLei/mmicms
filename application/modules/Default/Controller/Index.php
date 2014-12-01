<?php

class Default_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		foreach (Default_Registry::$db->tableList() as $tableName) {
			Mmi_Dao_Builder::buildFromTableName($tableName);
		}
	}

}
