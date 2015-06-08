<?php
/**
* Tindrem totes les funcions que el panell del administrador fa servir.
*
* @author SportSites
* @param  getSites ens serveix per obtenir els llocs de la nostra pagina
* @param  getUsuaris ens serveix per obtenir els usuaris que despres podrem administrar amb el admin
* @param  getCategories obtindrem les categories que tenim a la pagina
* @param  eliminarUsuari ens serveix per que el admin pugui eliminar els usuaris que cregui convenient
* @param  UsuariBanejat ens serveix per poder banejar a un usuari.
* @param  UsuaridesBanejat ens serveix per desbanejar a un usuari.
* @param  eliminarSite ens serveix per poder eliminar el lloc
* @param  eliminarCategoria ens serveix per poder eliminar la categoria
*
*/
	class administradorModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function getSites(){
        	
			$administrar = $this->_db->query("SELECT * FROM VSites");
        
			return $administrar->fetchall();
    	}
		
		public function getUsuaris(){
        	
			$administrar = $this->_db->query("SELECT * FROM Usuaris");
        
			return $administrar->fetchall();
    	}
		
		public function getCategories(){
	
		$site = $this->_db->query("SELECT * FROM VCategories");
		
		 return $site->fetchall();
		}
		
		public function eliminarUsuari($id){
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM Usuaris WHERE id_user = $id");
			
		}
		
		public function UsuariBanejat($id){
		
			$id = (int) $id;
			
			$this->_db->prepare("UPDATE Usuaris SET estat = 0 WHERE id_user = $id")->execute();

		}
		
		public function UsuaridesBanejat($id){
		
			$id = (int) $id;
			
			$this->_db->prepare("UPDATE Usuaris SET estat = 1 WHERE id_user = $id")->execute();

		}
		
		public function eliminarSite($id){
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM Sites WHERE id_site = $id");
			
		}
		
		public function eliminarCategoria($id){
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM Categories WHERE id_categoria = $id");
			
		}
		
		
		
	}
