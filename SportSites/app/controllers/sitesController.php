<?php

/**
* Servira per poder tenir una administracio dels perfils dels usuaris de la pagina i la seva subscripcio
*
* @author SportSites
* @param  propis ens serveix per ensenyar els llocs que hem inserit nomes nosaltres
* @param  filtrat ens serveix per poder filtrar
* @param  favorit sortiran els sites que hem donat a favorits,
* @param  site aqui tenim on podem veure un site on despres podrem editarlo
* @param  nou serveix per poder pujar un site nou a la nostra pagina
* @param  editar podem editar el site ja fet, per editar si volem algun dels seus atributs
*/

class sitesController extends Controller{
	
    private $_site;
    
    public function __construct(){
        
		parent::__construct();
        $this->_site = $this->loadModel('sites');
		
    }
    
    public function index(){
		
		if(Session::get('autenticat')){
        
			$this->_view->llocs = $this->_site->getSites();
			$this->_view->llocs_favorits = $this->_site->getFavorits();
			$this->_view->titol = 'Llocs';
			$this->_view->carrega('index', 'sites');
		
		}else{
			
			$this->_view->llocs = $this->_site->getSites();
        	$this->_view->titol = 'Llocs';
        	$this->_view->carrega('index', 'sites');
		
		}
    
	}
	
	public function propis(){
		
		if(Session::get('autenticat')){
        
			$this->_view->llocs = $this->_site->getSitesPropis();
			$this->_view->llocs_favorits = $this->_site->getFavorits();
			$this->_view->titol = 'Llocs Propis';
			$this->_view->carrega('propis', 'sites');
		
		}else{
			
        	$this->_view->titol = 'Llocs Propis';
        	$this->_view->carrega('propis', 'sites');
		
		}
    }
	
	public function filtrat($nom){
		        	
		$this->_view->llocs = $this->_site->filtrat($nom);
		
		$this->_view->categoria = $this->_site->getCategoria($nom);
		
		$this->_view->titol = 'Filtrats';
		
		$filtrado = $this->_view->categoria = $this->_site->getCategoria($nom);
		
		Session::set('categoria', $filtrado['nom']);
		
		$this->_view->carrega('filtrat', 'sites');
			
    }
	
	public function favorit($id){
	
		if(!$this->filtrarInt($id)){
			
            	$this->redirecciona('sites');
				
        	}
						
			 $this->_site->esFavorit(
                    
					$this->filtrarInt($id)
			);
			
			$this->redirecciona('sites');

	}
	
	public function site ($id){
	
		if(Session::get('autenticat')){
        
			if(!$this->filtrarInt($id)){
            	$this->redirecciona('sites');
        	}
        
        	if(!$this->_site->getSite($this->filtrarInt($id))){
            	$this->redirecciona('sites');
       		}
			
			$this->_view->dades = $this->_site->getSite($this->filtrarInt($id));
			$this->_view->imatges = $this->_site->getImgSite($this->filtrarInt($id));
			$this->_view->comentaris = $this->_site->getComentaris($this->filtrarInt($id));
			$this->_view->titol = 'Lloc';
			
			if($this->getInt('guardar') == 1){
            	            
				if(!$this->getTexto('comentari')){
					$this->_view->_error = 'Introdueix un comentari';
					$this->_view->carrega('site', 'sites');
					exit;
				}
				
				$this->_site->PublicarComentari($this->getTexto('comentari'));
				
				$comentari = $this->_site->UltComentari();
				
				$ultComentari = $comentari['id_comentari'];
				
				$usuari = Session::get('id_usuari');
				
				$this->_site->AsociarComentari($usuari, $ultComentari, $id);

				$this->redirecciona('sites/site/'.$id);
        	
			}       
			
			$this->_view->carrega('site', 'sites');

		}else{
			
        	$this->_view->titol = 'Lloc';
        	$this->_view->carrega('site', 'sites');
		
		}
	
	}
    
    public function nou(){
		
		$this->_view->categories = $this->_site->getCategories();
        
        $this->_view->titol = 'Nou Lloc';
                
        if($this->getInt('guardar') == 1){
            $this->_view->dades = $_POST;
            
            if(!$this->getTexto('titol')){
                
				$this->_view->_error[] = '· El titol del Lloc no pot estar buit!';
               
            }
            
            if(!$this->getTexto('descripcio')){
                
				$this->_view->_error[] = '· El lloc te que tenir una petita descripcio!';
               	
            }
			
			if(!$this->getInt('categoria')){
                
				$this->_view->_error[] = '· Es te que definir a que esport perteneix!';
                
            }
			
			if(!$this->getTexto('lloc')){
                
				$this->_view->_error[] = '· Especifica on es troba aquest Lloc!';
                
            }
			
			$imatge = $_FILES['imatge']['name'];
			
			if(!$imatge){
			
				$this->_view->_error[] = '· Introdueix una imatge principal per aquest lloc!';	
			
			}
			
			if(!$this->getTexto('titol')|| !$this->getTexto('descripcio') || !$this->getInt('categoria') || !$this->getTexto('lloc') || !$imatge){
			
				$this->_view->carrega('editar', 'sites');
                exit;
			
			}
										
			$con_ftp = ftp_connect(FTP_URL);
			$ftp_user = FTP_USER;
			$ftp_Pass = FTP_PASS;
			$ftp_login = ftp_login($con_ftp,$ftp_user,$ftp_Pass);
			$imatge = $_FILES['imatge']['name'];
			$imatges = $_FILES['imatges']['name'];
			$ruta = RUTA_FTP_IMG.IMG_SITES.$_FILES['imatge']['name'];
			@move_uploaded_file($_FILES["imatge"]["tmp_name"], $ruta);
			
			
			
			$this->_site->insertarSite(
                    $this->getTexto('titol'),
                    $this->getTexto('descripcio'),
					$this->getInt('categoria'),
					$this->getTexto('lloc'),
					$imatge
					
					
                    );
					
			
			$site = $this->_site->UltSiteInsert();
			
			$ultSite = $site['id_site'];
												
			for($i = 0; $i < count($imatges); $i++){
			
				$ruta = RUTA_FTP_IMG.IMG_SITES.$_FILES['imatges']['name'][$i];
				@move_uploaded_file($_FILES["imatges"]["tmp_name"][$i], $ruta);
				
				$this->_site->ImgsSites($_FILES['imatges']['name'][$i], $ultSite);
					
			}
			
			
            $this->redirecciona('sites');
        }       
        
        $this->_view->carrega('nou', 'sites');
    }
    
    public function editar($id){
		
		$this->_view->categories = $this->_site->getCategories();
        
		if(!$this->filtrarInt($id)){
            $this->redirecciona('sites');
        }
        
        if(!$this->_site->getSite($this->filtrarInt($id))){
            $this->redirecciona('sites');
        }
        
        $this->_view->titol = 'Editar Lloc';
               
        if($this->getInt('guardar') == 1){
            
			$this->_view->dades = $_POST;
			            
            if(!$this->getTexto('titol')){
                
				$this->_view->_error[] = '· El titol del Lloc no pot estar buit!';
               
            }
            
            if(!$this->getTexto('descripcio')){
                
				$this->_view->_error[] = '· El lloc te que tenir una petita descripcio!';
               	
            }
			
			if(!$this->getInt('categoria')){
                
				$this->_view->_error[] = '· Es te que definir a que esport perteneix!';
                
            }
			
			if(!$this->getTexto('lloc')){
                
				$this->_view->_error[] = '· Especifica on es troba aquest Lloc!';
                
            }
			
			if(!$this->getTexto('titol')|| !$this->getTexto('descripcio') || !$this->getInt('categoria') || !$this->getTexto('lloc')){
			
				$this->_view->carrega('editar', 'sites');
                exit;
			
			}
			
			$con_ftp = ftp_connect(FTP_URL);
			$ftp_user = FTP_USER;
			$ftp_Pass = FTP_PASS;
			$ftp_login = ftp_login($con_ftp,$ftp_user,$ftp_Pass);
			$imatge = $_FILES['imatge']['name'];
			$imatges = $_FILES['imatges']['name'];
			$ruta = RUTA_FTP_IMG.IMG_SITES.$_FILES['imatge']['name'];
			@move_uploaded_file($_FILES["imatge"]["tmp_name"], $ruta);
			
			 $this->_site->editarSite(
                    
					$this->filtrarInt($id),
                    $this->getTexto('titol'),
                    $this->getTexto('descripcio'),
					$this->getInt('categoria'),
					$this->getTexto('lloc'),
					$imatge
					
					
                    );
					
			$filas = $this->_site->getidMultimedia($this->filtrarInt($id));
			$multimedia = $filas['id_multimedia'];
			$multimedia = (int) $multimedia;
									
			for($i = 0; $i < count($imatges); $i++){
			
				$ruta = RUTA_FTP_IMG.IMG_SITES.$_FILES['imatges']['name'][$i];
				@move_uploaded_file($_FILES["imatges"]["tmp_name"][$i], $ruta);				
				$this->_site->UpdateImgsSites($multimedia,$_FILES['imatges']['name'][$i],$this->filtrarInt($id));
				$multimedia = $multimedia +1;
					
			}
            
            $this->redirecciona('sites');
        }
        
        $this->_view->dades = $this->_site->getSite($this->filtrarInt($id));
        $this->_view->carrega('editar', 'sites');
    }
	
	
	
	
    
}

?>

