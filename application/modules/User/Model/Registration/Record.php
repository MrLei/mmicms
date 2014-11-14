<?php

class User_Model_Registration_Record extends Cms_Model_Auth_Record {

    /**
     *
     * @var string
     */
    public $password;
    
    /**
     *
     * @var string
     */
    public $confirmPassword;
    
    /**
     *
     * @var string
     */
    public $changePassword;
    
    /**
     *
     * @var boolean
     */
    public $regulations;
    
//    protected $_extras = array('password');
    
	public function save() {
		if ($this->password != $this->confirmPassword) {
			return false;
		}
		$this->changePassword = $this->password;
		unset($this->password);
		$this->lang = 'pl';
		unset($this->regulations);
		unset($this->confirmPassword);
		return parent::save();
	}

}