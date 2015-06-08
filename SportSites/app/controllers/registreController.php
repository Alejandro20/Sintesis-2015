<?php
/**
* Ens serveix per poder registrar els usuaris a dins de la pagina.
*
* @author SportSites
* @param  registreController amb la funcion index a dins, ens serveix per poder registrar cada usuari a dins de la nostra pagina, inserin els atributs que te cada usuari, que s'introduiran a dins de la nostra base de dades. 
* 
*/
class registreController extends Controller
{
    private $_registre;
    
    public function __construct() {
        parent::__construct();
        
        $this->_registre = $this->loadModel('registre');
    }
    
    public function index(){
       
        
        $this->_view->titol = 'Registre';
        
        if($this->getInt('Registrarse') == 1){
            $this->_view->datos = $_POST;
            
			
			if(!$this->validarEmail($this->getPostParam('email'))){
                
				$this->_view->_error[] = 'La direccio de email es invalida';
                
            }
			
			 if($this->_registre->verificarEmail($this->getPostParam('email'))){
                
				$this->_view->_error[] = 'Aquesta direccio email ja esta registrada';
                
            }

            if($this->_registre->verificarUsuari($this->getAlphaNum('usuari'))){
                
				$this->_view->_error[] = 'El usuari ' . $this->getAlphaNum('usuari') . ' ya existeix';
                
            }
            
            
            if($this->getPostParam('pass') != $this->getPostParam('confirmar')){
                
				$this->_view->_error[] = 'Els passwords no coincideixen';
                
            }
			
			if(!$this->validarEmail($this->getPostParam('email')) || $this->_registre->verificarEmail($this->getPostParam('email')) || $this->_registre->verificarUsuari($this->getAlphaNum('usuari')) || $this->getPostParam('pass') != $this->getPostParam('confirmar')){
			
				$this->_view->carrega('index', 'registre');
                exit;
			
			}
			
            $this->_registre->registrarUsuari(
                    $this->getSql('nom'),
					$this->getSql('cognoms'),
					$this->getSql('localitat'),
					$this->getSql('sexe'),
					$this->getSql('telefon'),
                    $this->getPostParam('email'),
                    $this->getSql('usuari'),
                    md5($this->getSql('pass'))
                    );
            
			$usuario = $this->_registre->verificarUsuari($this->getAlphaNum('usuari'));
			
            if(!$usuario){
                $this->_view->_error[] = 'Error al registrar el usuari';
                $this->_view->carrega('index', 'registre');
                exit;
            
			}else{
				
				header("Location:index.php");
			
			}
			
        }        
        
        $this->_view->carrega('index', 'registre');
		
		
    }

}

?>
