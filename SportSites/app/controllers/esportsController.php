<?php
/**
* Serveix per tenir els esports, que son les diferents categories de la nostra pagina
*
* @author SportSites
* @param  esportsController carregarem el controlador per les categories
* @param index carregarem les diferents categories amb el getcategories
* @param nou ens serveix per poder inserir una nova categoria.
* @param editarCategoria ens serveix per poder editar una categoria ja insertada.
*/

class esportsController extends Controller{
	
    private $_esports;
    
    public function __construct(){
        
		parent::__construct();
        $this->_esports = $this->loadModel('esports');
		
    }
	
	public function index(){
		
			$this->_view->esports = $this->_esports->getCategories();
			$this->_view->titol = 'Esports';
			$this->_view->carrega('index', 'esports');

    }
	
	public function nou(){
		        
        $this->_view->titol = 'Nou Esport';
        
        if($this->getInt('guardar') == 1){
            
			$this->_view->dades = $_POST;
            
            if(!$this->getTexto('nom')){
                
				$this->_view->_error[] = 'El titol del Esport no pot estar buit!';
                
            }
            
            if(!$this->getTexto('descripcio')){
                
				$this->_view->_error[] = "L'Esport te que tenir una petita descripcio!";
                
            }
		
			$con_ftp = ftp_connect(FTP_URL);
			$ftp_user = FTP_USER;
			$ftp_Pass = FTP_PASS;
			$ftp_login = ftp_login($con_ftp,$ftp_user,$ftp_Pass);
			$ruta = RUTA_FTP_IMG.IMG_ESPORTS.$_FILES['imatge']['name'];
            $imatge = $_FILES['imatge']['name'];
			
			if(!$imatge){
			
				$this->_view->_error[] = "Introdueix una imatge de l'Esport.";
			
			}
			
			if(!$this->getTexto('nom') || !$this->getTexto('descripcio') || !$imatge){
			
				$this->_view->carrega('nou', 'esports');
                exit;
			
			}
			
			@move_uploaded_file($_FILES["imatge"]["tmp_name"], $ruta);
	
            $this->_esports->insertEsport(
                    
					$this->getTexto('nom'),
                    $this->getTexto('descripcio')	
					
            );
			
			$ult_categoria = $this->_esports->getCategoriaInsert();
									
			$categoria = $ult_categoria['id_categoria'];	
			
			$this->_esports->UpdateImgEsport($imatge, $categoria);
			
			$this->redirecciona('administrador/categories');
        
		}       
        
        $this->_view->carrega('nou', 'esports');
    }
	
	public function editarCategoria($id){
		        
        if(!$this->filtrarInt($id)){
            $this->redirecciona('administrador/categories');
        }
		
		if(!$this->_esports->getCategoria($this->filtrarInt($id))){
            $this->redirecciona('administrador/categories');
        }
		
		$this->_view->titol = 'Editar Esport';
        
        if($this->getInt('guardar') == 1){
            
			$this->_view->dades = $_POST;
            
            if(!$this->getTexto('nom')){
                
				$this->_view->_error[] = 'El titol del Esport no pot estar buit!';
                
            }
            
            if(!$this->getTexto('descripcio')){
                
				$this->_view->_error[] = "L'Esport te que tenir una petita descripcio!";
                
            }
		
			$con_ftp = ftp_connect(FTP_URL);
			$ftp_user = FTP_USER;
			$ftp_Pass = FTP_PASS;
			$ftp_login = ftp_login($con_ftp,$ftp_user,$ftp_Pass);
			$ruta = RUTA_FTP_IMG.IMG_ESPORTS.$_FILES['imatge']['name'];
            $imatge = $_FILES['imatge']['name'];

			if(!$this->getTexto('nom') || !$this->getTexto('descripcio')){
			
				$this->_view->carrega('nou', 'esports');
                exit;
			
			}

			@move_uploaded_file($_FILES["imatge"]["tmp_name"], $ruta);
	
            $this->_esports->UpdateEsport(
                    
					$this->filtrarInt($id),
					$this->getTexto('nom'),
                    $this->getTexto('descripcio')	
					
                    );
			
			$this->_esports->UpdateImgEsport($imatge, $this->filtrarInt($id));
			
			$this->redirecciona('administrador/categories');
        
		}       
        
		$this->_view->dades = $this->_esports->getCategoria($this->filtrarInt($id));
        $this->_view->carrega('editar', 'esports');
    
	}

}

?>