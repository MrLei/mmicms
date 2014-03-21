<?php

class Mail_Plugin_ServerGrid extends Mmi_Grid {

    protected $_daoName = 'Mail_Model_Server_Dao';

    public function init() {

        $this->addColumn('text', 'address', array(
            'label' => 'Adres serwera',
        ));

        $this->addColumn('text', 'port', array(
            'label' => 'Port',
        ));

		$this->addColumn('text', 'ssl', array(
            'label' => 'Szyfrowanie',
        ));

        $this->addColumn('text', 'username', array(
            'label' => 'Użytkownik',
        ));

        $this->addColumn('text', 'from', array(
            'label' => 'Domyślny nadawca',
        ));

        $this->addColumn('text', 'dateAdd', array(
            'label' => 'Data dodania',
        ));

        $this->addColumn('text', 'dateModify', array(
            'label' => 'Data modyfikacji',
        ));

        $this->addColumn('buttons', 'buttons', array(
            'label' => 'operacje',
        ));
    }

}
