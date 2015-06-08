<?php
/**
* Servira per poder tenir una administracio dels usuaris que estan loguejats o no
*
* @author SportSites
* @param loginController ens serveix per poder controlar els usuaris que estan o no loguejats
* @param tancar serveix per tancar la sessio del usuari loguejat
*/
class loginController extends Controller
{
    private $_login;
    
    public function __construct(){
        parent::__construct();
        $this->_login = $this->loadModel('login');
    }
    
    public function index(){
		
        if(Session::get('autenticat')){
            
			$this->redirecciona();
			
        }
        
        $this->_view->titol = 'Iniciar Sessio';
        
        if($this->getInt('enviar') == 1){
			
            $this->_view->datos = $_POST;
                        
            $login = $this->_login->getUsuario(
			
                   					$this->getAlphaNum('usuario'),
                    				md5($this->getSql('pass'))
									
                    			);
            
            if(!$login){
				
                $this->_view->_error[] = 'Usuari o password incorrectes';
                $this->_view->carrega('index','login');
                exit;
				
            }
            
            if($login['estat'] != 1){
				
                $this->_view->_error[] = 'Aquest Usuari ha estat banejat!';
                $this->_view->carrega('index','login');
                exit;
				
            }
			
                        
            Session::set('autenticat', true);
            Session::set('admin', $login['rol']);
            Session::set('usuari', $login['usuari']);
            Session::set('id_usuari', $login['id_user']);
            Session::set('tiemps', time());

			$subscripcio = $this->_login->getSubscripcio();
			
			Session::set('subscrit',$subscripcio['subscrit']);
						
			$this->redirecciona();
        }
        
        $this->_view->carrega('index','login');
        
    }
    
    public function tancar(){
		
        Session::tanca();
        $this->redirecciona();
		
    }
}

?>

