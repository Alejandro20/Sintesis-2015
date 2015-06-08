<?php
/**
* Aqui es on tenim totes les variables amb les seves rutes.
*
* @author SportSites
* @param Request serveix per poder fer servir les urls a la nostra app
* @param getControlador aqui farem servir el controlador, on el cridem
* @param getMetode aqui podrem fer servir el metode, on el cridem
* @param getArgs aqui podrem ficar els arguments que necesitem
*/
class Request{
	
    private $_controlador;
    private $_metode;
    private $_arguments;
    
    public function __construct() {
		
        if(isset($_GET['url'])){
			
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            
            $this->_controlador = strtolower(array_shift($url));
            $this->_metode = strtolower(array_shift($url));
            $this->_arguments = $url;
			
        }       
        
        if(!$this->_controlador){
			
            $this->_controlador = DEFAULT_CONTROLLER;
			
        }
        
        if(!$this->_metode){
			
            $this->_metode = 'index';
			
        }
        
        if(!isset($this->_arguments)){
            
			$this->_arguments = array();
        
		}
    
	}
    
    public function getControlador(){
		
        return $this->_controlador;
		
    }
    
    public function getMetode(){
		
        return $this->_metode;
		
    }
    
    public function getArgs(){
		
        return $this->_arguments;
		
    }
	
}

?>