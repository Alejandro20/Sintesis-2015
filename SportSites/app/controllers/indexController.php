<?php
/**
* 
*
* @author SportSites
* @param  indexController carregarem els llocs que tenim de la pagina.
* 
* 
* 
*/
class indexController extends Controller{
	
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
		
        $Sites = $this->loadModel('sites');
		        
        $this->_view->sites = $Sites->getSites();
        
        $this->_view->titol = 'SportSites';
        $this->_view->carrega('index', 'index');
    
	}
	
	public function info_subscripcio(){
		$Sites = $this->loadModel('sites');
		
		$this->_view->titol = 'Subscripcio';
        $this->_view->carrega('subscripcio', 'index');
	
	}
	
	public function info_quisom(){
		
		$Sites = $this->loadModel('sites');
		$this->_view->titol = 'Qui Som?';
        $this->_view->carrega('quisom', 'index');
	
	}
}

?>