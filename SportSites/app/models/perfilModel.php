<?php
/**
* Tindrem totes les funcions que es pot fer en la finestra del perfil 
* @author SportSites 
* @param  verificarUsuari serveix per verificar els usuaris
* @param  verificarEmail serveix per verificar si esta be el email
* @param  Refrescar veurem la subscripcio segons el usuari que esta inscrit
* @param  getUsuari obtindrem el usuari
* @param  getSubscriptor  obtindrem el subscriptor 
* @param  editarPerfil serveix per poder editar el perfil de usuaris
* @param  Subscriure  serveix per les dades de la subscripcio
* @param  BaixaSubscripcio serveix per donar de baixa la subscripcio
*
*/
	class perfilModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function verificarUsuari($usuari){
			
        	$id = $this->_db->query("SELECT id_user FROM Usuaris WHERE usuari = '$usuari'");
        
        return $id->fetch();
    	}
		
		public function verificarEmail($email){
			
			$id = $this->_db->query("SELECT id_user FROM Usuaris WHERE email = '$email'");
			
			if($id->fetch()){
				
				return true;
			}
        
        	return false;
    	}
		
		public function Refrescar(){
	
			$usuari = Session::get('id_usuari');
	
			$subscripcio = $this->_db->query("SELECT * FROM Subscripcio WHERE usuari = $usuari");
			
			return $subscripcio->fetch();
		
		}
		
		public function getUsuari($id){
			
			$id = (int) $id;
			$perfil = $this->_db->query("SELECT * FROM Usuaris WHERE id_user = $id");
			return $perfil->fetch();
    	
		}
		
		public function getSubscriptor($id){
		
			$usuari = (int) $id;
			$subscriptor = $this->_db->query("SELECT * FROM Subscripcio WHERE usuari = $usuari");
			return $subscriptor->fetch();	
		
		}

		public function editarPerfil($id, $nom, $cognoms,$email,$password,$rol,$imatge){
						
				if(!$imatge){
					
					if(Session::get('admin')==1){
					
						$id = (int) $id;
						$this->_db->prepare("UPDATE Usuaris SET nom = :nom, cognoms = :cognoms, email = :email, password = :pass, rol = :rol WHERE id_user = :id")
						->execute(
						
								array(
								   ':id' => $id,
								   ':nom' => $nom,
								   ':cognoms' => $cognoms,
								   ':email'=>$email,
								   ':pass' =>$password,
								   ':rol'=>$rol,
								   
								));
					}else{
						
						$id = (int) $id;
						
						$rol = (int) Session::get('admin');	
						
						$this->_db->prepare("UPDATE Usuaris SET nom = :nom, cognoms = :cognoms, email = :email, password = :pass, rol = :rol WHERE id_user = :id")
								->execute(
								
										array(
										   ':id' => $id,
										   ':nom' => $nom,
										   ':cognoms' => $cognoms,
										   ':email'=>$email,
										   ':pass' =>$password,
										   ':rol'=>$rol,
										   
										));
					}

				}else{
					
					if(Session::get('admin')==1){
					
						$id = (int) $id;
						$this->_db->prepare("UPDATE Usuaris SET nom = :nom, cognoms = :cognoms, email = :email, password = :pass, rol = :rol, imatge_perfil = :imatge WHERE id_user = :id")
						->execute(
						
								array(
								   ':id' => $id,
								   ':nom' => $nom,
								   ':cognoms' => $cognoms,
								   ':email'=>$email,
								   ':pass' =>$password,
								   ':rol'=>$rol,
								   ':imatge' =>$imatge
								));
					}else{
						
						$id = (int) $id;
						
						$rol = (int) Session::get('admin');	
						
						$this->_db->prepare("UPDATE Usuaris SET nom = :nom, cognoms = :cognoms, email = :email, password = :pass, rol = :rol, imatge_perfil = :imatge WHERE id_user = :id")
								->execute(
								
										array(
										   ':id' => $id,
										   ':nom' => $nom,
										   ':cognoms' => $cognoms,
										   ':email'=>$email,
										   ':pass' =>$password,
										   ':rol'=>$rol,
										   ':imatge' =>$imatge
										));
					}
				}
	
		}
		
		public function Subscriure($metodePagament,$C_Bancaria,$usuari){
			
			$usuari = (int) $usuari;
			
			$this->_db->prepare("UPDATE Subscripcio SET metode_pagament = :metodePagament, preu = 2, c_bancaria = :C_Bancaria, subscrit = 'SI' WHERE usuari = :usuari")
						->execute(
						
								array(
								  
								   ':metodePagament' => $metodePagament,
								   ':C_Bancaria' => $C_Bancaria,
								   ':usuari' => $usuari
								   
								));	
		
		}
		
		public function BaixaSubscripcio($id){
		
			$usuari = (int) $id;
			
			$this->_db->prepare("UPDATE Subscripcio SET metode_pagament = 'No Definit', preu = 0, subscrit = 'NO' WHERE usuari = $usuari")->execute();
						
		}
	

	}
?>