<?php
/**
* Model del site
*
* @author SportSites
* @param Model serveix per poder carregar els models
*/
class Model{
	
    protected $_db;

    public function __construct() {
        
		$this->_db = new Database();
    
	}

}

?>
