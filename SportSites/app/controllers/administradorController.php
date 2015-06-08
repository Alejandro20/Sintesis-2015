<?php

/**
* Controla el admin del sistema, per poderlo fer servir.
*
* @author SportSites
* 
*/
	class administradorController extends Controller{
		
		private $_administrador;
		
		public function __construct(){
			
			parent::__construct();
			
			$this->_administrador = $this->loadModel('administrador');
			
		}

/**
* La funcio index serveix per el administrador estigui autenticat o no.
*
* @author SportSites
* @param  index ens mira si el usuari esta autenticat com admin, la vista s'encarrega de fer anar al usuari no loguejat que torni endarrera.
* 
* 
* 
*/
		public function index(){
		
			if(Session::get('autenticat') && Session::get('admin') == 1){
				
				$this->_view->titol = 'Administrador';
				$this->_view->carrega('index', 'administrador');
			
			}else{
				
				$this->_view->titol = 'Administrador';
        		$this->_view->carrega('index', 'administrador');
			}
		}
		
/**
* La funcio usuaris serveix per veure si estas loguejat o no com usuari administrador.
*
* @author SportSites
* @param  usuaris ens serveix per si estem com a admin, poder fer servir la funcio get usuaris on poder administrar els usuaris que tenim a la pagina.
* 
* 
* 
*/
		public function usuaris(){
			
			if(Session::get('autenticat') && Session::get('admin') == 1){
			
				$this->_view->administradorUsuaris = $this->_administrador->getUsuaris();
				$this->_view->titol = 'Administrar Usuaris';
				$this->_view->carrega('usuaris', 'administrador');
			
			}else{
				
				$this->_view->titol = 'Administrar Usuaris';
        		$this->_view->carrega('usuaris', 'administrador');
			}
			
    	}

/**
* La funcio llocs serveix per si estas loguejat o no com a admin mostrar una cosa o una altra.
*
* @author SportSites
* @param  llocs ens serveix per si estem com a admin, poder fer servir la funcio get sites on poder administrar els llocs que tenim a la pagina.
* 
* 
* 
*/
		public function llocs(){
			
			if(Session::get('autenticat') && Session::get('admin') == 1){
			
				$this->_view->administradorLlocs = $this->_administrador->getsites();
				$this->_view->titol = 'Administrar Llocs';
				$this->_view->carrega('llocs', 'administrador');
			
			}else{
				
				$this->_view->titol = 'Administrar Llocs';
        		$this->_view->carrega('llocs', 'administrador');
			}
			
    	}
		
		
/**
* La funcio categories serveix per si estas loguejat o no com a admin mostrar una cosa o una altra.
*
* @author SportSites
* @param  categories ens serveix per si estem com a admin, poder fer servir la funcio get categories on poder administrar les categories que tenim a la pagina.
* 
* 
* 
*/
		public function categories(){
			
			if(Session::get('autenticat') && Session::get('admin') == 1){
			
				$this->_view->administradorCategories = $this->_administrador->getCategories();
				$this->_view->titol = 'Administrar Categories';
				$this->_view->carrega('categories', 'administrador');
			
			}else{
				
				$this->_view->titol = 'Administrar Categories';
        		$this->_view->carrega('categories', 'administrador');
			}
			
    	}
		
/**
* Servira per poder tenir una administracio dels usuaris.
*
* @author SportSites
* @param  eliminarUsuari filtrarem per el id del usuari per poder eliminarlo.
* 
* 
* 
*/
		public function eliminarUsuari($id){
			
			if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('administrador/usuaris');
				
        	}
						
			 $this->_administrador->eliminarUsuari(
                    
					$this->filtrarInt($id)
					
			);
			
			$this->redirecciona('administrador/usuaris');
		
		}
		
/**
* Servira per poder tenir una administracio dels categories.
*
* @author SportSites
* @param  eliminarCategoria filtrarem per el id del categoria per poder eliminarlo.
* 
* 
* 
*/
		public function eliminarCategoria($id){
			
			if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('administrador/categories');
				
        	}
						
			 $this->_administrador->eliminarCategoria(
                    
					$this->filtrarInt($id)
					
			);
			
			$this->redirecciona('administrador/categories');
		
		}

/**
* Servira per poder tenir una administracio del usuari que esta o no banejat.
*
* @author SportSites
* @param  UsuariBanejat filtrarem per el id del usuari per poder banejarlo.
* 
* 
* 
*/
		public function UsuariBanejat($id){
		
			if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('administrador/usuaris');
				
        	}
						
			 $this->_administrador->UsuariBanejat(
                    
					$this->filtrarInt($id)
					
			);
			
			$this->redirecciona('administrador/usuaris');
		
		}
/**
* Servira per poder tenir una administracio del usuari que esta o no banejat.
*
* @author SportSites
* @param  UsuaridesBanejat filtrarem per el id del usuari per poder desbanejarlo.
* 
* 
* 
*/
		public function UsuaridesBanejat($id){
		
			if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('administrador/usuaris');
				
        	}
						
			 $this->_administrador->UsuaridesBanejat(
                    
					$this->filtrarInt($id)
					
			);
			
			$this->redirecciona('administrador/usuaris');
		
		}
	
/**
* Servira per poder tenir una administracio dels llocs
*
* @author SportSites
* @param  eliminarSite filtrarem per el id del usuari per poder borrarlo.
* 
* 
* 
*/
		public function eliminarSite($id){
			
			if(!$this->filtrarInt($id)){
				
            	$this->redirecciona('administrador/llocs');
				
        	}
						
			 $this->_administrador->eliminarSite(
                    
					$this->filtrarInt($id)
					
			);
			
			$this->redirecciona('administrador/llocs');
		
		}
	}
	
