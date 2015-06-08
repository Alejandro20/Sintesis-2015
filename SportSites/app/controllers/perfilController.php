<?php
/**
* Servira per poder tenir una administracio dels perfils dels usuaris de la pagina i la seva subscripcio
*
* @author SportSites
* @param  perfilController serveix per controlar el perfil
* @param  editar ens serveix per poder editar els parametres de cada perfil del usuari
* @param  subscriure administra la subscripcio dels usuaris que estan subscrits o que es volen subscriure
* @param  BaixaSubscripcio dona de baixa als usuaris que estan oberts amb la subscripcio
*
*/
class perfilController extends Controller
{
	private $_perfil;
	
    public function __construct() {
        parent::__construct();
		$this->_perfil = $this->loadModel('perfil');
    }
    
    public function index(){
		
		if(Session::get('autenticat')){
			
            $this->_view->titol = 'Perfil';
			$this->_view->carrega('index', 'perfil');
        
		}else{
			
        	$this->_view->titol = 'Perfil';
        	$this->_view->carrega('index', 'perfil');
		
		}
	}
		
	public function editar($id){
		        
		if(!$this->filtrarInt($id)){
            $this->redirecciona('perfil');
        }
        
        if(!$this->_perfil->getUsuari($this->filtrarInt($id))){
            $this->redirecciona('perfil');
        }
        
        $this->_view->titol = 'Editar Perfil';
       
        
        if($this->getInt('guardar') == 1){
            
			$this->_view->dades = $_POST;
        
				if(!$this->getSql('nom')){
					
					$this->_view->_error[] = 'El Nom no pot estar buit';
					
					
				}
				
				 if(!$this->getSql('cognoms')){
					
					$this->_view->_error[] = 'Els Cognoms no poden estar buits';
					
					
				}
				
				if(!$this->validarEmail($this->getPostParam('email'))){
					
					$this->_view->_error[] = 'La direccio email es invalida';
					
					
				}
				
				
				if(!$this->getSql('pass')){
					
					$this->_view->_error[] = 'Introdueix una nova Password';
					
				}
				
				if($this->getPostParam('pass') != $this->getPostParam('confirmar')){
					
					$this->_view->_error[] = 'Els passwords no coincideixen';
					
				}

				$con_ftp = ftp_connect(FTP_URL);
				$ftp_user = FTP_USER;
				$ftp_Pass = FTP_PASS;
				$ftp_login = ftp_login($con_ftp,$ftp_user,$ftp_Pass);
				$ruta = RUTA_FTP_IMG.IMG_PERFIL.$_FILES['imatge']['name'];
            	$imatge = $_FILES['imatge']['name'];
				@move_uploaded_file($_FILES["imatge"]["tmp_name"], $ruta);
				
				if(Session::get('admin')==1){
					
					if(!$this->getPostParam('rol')){
						$this->_view->_error[] = 'Indica el Rol';
						
					}
					
					if(!$this->getSql('nom') || !$this->getSql('cognoms') || !$this->validarEmail($this->getPostParam('email')) ||  !$this->getSql('pass') || $this->getPostParam('pass') != $this->getPostParam('confirmar') || !$this->getPostParam('rol')){
					
						$this->_view->carrega('editar', 'perfil');
						exit;
				
					}
				
					$this->_perfil->editarPerfil(
						
						$this->filtrarInt($id),
						$this->getSql('nom'),
						$this->getSql('cognoms'),
						$this->getPostParam('email'),
						md5($this->getSql('pass')),
						$this ->getPostParam('rol'),
						$imatge			
						
					);
				
				}else{
					
					if(!$this->getSql('nom') || !$this->getSql('cognoms') || !$this->validarEmail($this->getPostParam('email')) ||  !$this->getSql('pass') || $this->getPostParam('pass') != $this->getPostParam('confirmar')){
					
						$this->_view->carrega('editar', 'perfil');
						exit;
				
					}
				
					$this->_perfil->editarPerfil(
							
							$this->filtrarInt($id),
							$this->getSql('nom'),
							$this->getSql('cognoms'),
							$this->getPostParam('email'),
							md5($this->getSql('pass')),
							$this ->getPostParam('rol'),
							$imatge					
							
					);
				}
				
								
				$usuario = $this->_perfil->verificarUsuari($this->getAlphaNum('usuario'));
				
				if(Session::get('admin')==1){
				
					$this->redirecciona('administrador');
				
				}else{
				
					$this->redirecciona('perfil');
				
				}
				
				if(!$usuario){
					$this->_view->_error[] = 'Error en actualitzar el Usuari';
					$this->_view->carrega('editar', 'perfil');
					exit;
		
				}
        
    	}
		
        $this->_view->dades = $this->_perfil->getUsuari($this->filtrarInt($id));
        $this->_view->carrega('editar', 'perfil');

	}
	
	public function Subscriure($id){
	
		if(!$this->filtrarInt($id)){
            $this->redirecciona('perfil');
        }
		
		if(!$this->_perfil->getSubscriptor($this->filtrarInt($id))){
            $this->redirecciona('perfil');
        }
		
		 $this->_view->titol = 'Subscriure Usuari';
		 
		 if($this->getInt('guardar') == 1){
            
			$this->_view->datos = $_POST;	
				
					if(!$this->getSql('metodePagament')){
						
						$this->_view->_error = 'Introdueix un metode de  Pagament';
						
					}
					
					if(!$this->getSql('c_bancaria')){
						
						$this->_view->_error = 'Introduix una Compta Bancaria';
						
					}
					
					if(!$this->getSql('metodePagament') || !$this->getSql('c_bancaria')){
						
						$this->_view->carrega('subscriure', 'perfil');
						exit;
					
					}
					
					$this->_perfil->Subscriure(
					
						$this->getSql('metodePagament'),
						$this->getSql('c_bancaria'),
						$this->filtrarInt($id)
						
					);
					
					$Refrescado = $this->_perfil->Refrescar();
					
					Session::set('subscrit',$Refrescado['subscrit']);
					
					$this->redirecciona('perfil');
		 }
		 
		 $this->_view->dades = $this->_perfil->getSubscriptor($this->filtrarInt($id));
		 $this->_view->carrega('subscriure', 'perfil');
				
				
	
	}
	
	public function BaixaSubscripcio($id){
	
		if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('perfil');
				
        	}
						
			 $this->_perfil->BaixaSubscripcio(
                    
					$this->filtrarInt($id)
					
			);
			
			$Refrescado = $this->_perfil->Refrescar();
					
			Session::set('subscrit',$Refrescado['subscrit']);
			
			$this->redirecciona('perfil');
	
	}
}

?>