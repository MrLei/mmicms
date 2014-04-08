<?php

class Mail_Plugin_Grid extends Mmi_Grid {

    protected $_daoName = 'Mail_Model_Dao';

    public function init() {

		$q = new Mmi_Dao_Query();
		$this->setInitialQuery($q->orderDesc('id'));

        $this->addColumn('checkbox', 'active', array(
                'label' => 'Wysłany',
        ));

		$this->addColumn('text', 'dateAdd', array(
                'label' => 'Data dodania',
        ));

        $this->addColumn('text', 'dateSent', array(
                'label' => 'Data wysłania',
        ));

		$this->addColumn('text', 'to', array(
                'label' => 'Do',
        ));

        $this->addColumn('text', 'subject', array(
                'label' => 'Temat',
        ));

        $this->addColumn('text', 'fromName', array(
                'label' => 'Od',
        ));

        $this->addColumn('buttons', 'buttons', array(
                'label' => 'operacje',
                'links' => array(
                        'edit' => null
                )
        ));
    }

}
