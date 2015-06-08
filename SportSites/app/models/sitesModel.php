<?php

/**
* Tindrem totes les funcions que el panell del administrador fa servir.
*
* @author SportSites
* @param  getSites obtindrem els sites
* @param  getSitesPropis obtindrem els sites que hem pujat nosaltres
* @param  getSite obtenir un site per id
* @param  getImgSite obtenir imatges de un site
* @param  esFavorit obtindrem els favorits que son favorits de aquell usuari
* @param  getFavorits obtindrem els favorits
* @param  getCategories obtindrem les categories
* @param  filtar servira per poder filtrar per usuari
* @param  getComentaris serveix per obtenir els comentaris dels usuaris
* @param  insertarSite serveix per insertar els sites
* @param  editarSite serveix per editar els sites que tenim filtrat
* @param  PublicarComentari serveix per poder inserir un comentari
* @param  UltComentari serveix per poder veure el ultim comentari que esta inserit
*/

	class sitesModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function getSites(){
			
			$site = $this->_db->query("SELECT * FROM VSites ORDER BY data DESC");
			return $site->fetchall();
		
		}
			
		public function getSitesPropis(){
			
			$user = Session::get('id_usuari');					
			$site = $this->_db->query("SELECT * FROM VSites WHERE usuari = $user ORDER BY data DESC");
			return $site->fetchall();
		
		}
		
		
		public function getSite($id){
			
			$id = (int) $id;
			$site = $this->_db->query("SELECT * FROM VSites WHERE id_site = $id");
			return $site->fetch();
			
		}
		
		public function getImgSite($id){
		
			$id = (int) $id;
			
			$imgs = $this->_db->query("SELECT * FROM Multimedia WHERE site = $id");
			
			return $imgs->fetchall();
		
		}
		
		public function esFavorit($site){
		
			$user = Session::get('id_usuari');
			$this->_db->prepare("INSERT INTO Favorits VALUES(:site, :usuari)")
							
							->execute(
								
								array(
								   
								   ':site' => $site,
								   ':usuari' => $user
								   
								));
			
		
		}
		
		public function getFavorits(){
			
			$user = Session::get('id_usuari');
			
			$site = $this->_db->query("SELECT *
									   FROM VFavorits
									   WHERE usuari = $user
									   ");
			 return $site->fetchall();
		
		}
		
		public function getCategories(){
		
			$site = $this->_db->query("SELECT * FROM Categories");
			
			 return $site->fetchall();
		}
		
		
		public function getCategoria($categoria){
		
				$categorias = $this->_db->query("SELECT * FROM VCategories WHERE nom = '$categoria'");
				
				return $categorias->fetch();
			
		}
			
		public function filtrat ($categoria){
				
			$categorias = $this->_db->query("SELECT * FROM VSites WHERE Categoria = '$categoria' ORDER BY data DESC");
			
			return $categorias->fetchall();
		
		}
		
		public function getComentaris($site){
		
			$comentaris = $this->_db->query("SELECT * FROM VComentaris WHERE site = $site");
			return $comentaris->fetchall(); 
		
		}
		
		public function insertarSite($titulo, $descripcion,$categoria,$lloc,$imatge){
			
			$user = Session::get('id_usuari');	
			$categorias = (int) $categoria;
			
			$this->_db->prepare("INSERT INTO Sites (id_site,titol,descripcio,categoria, lloc, imatge,data,usuari) VALUES
								(null, :titol, :descripcio,:categoria,:lloc,:imatge,now(),$user)")
					->execute(
							array(
							   ':titol' => $titulo,
							   ':descripcio' => $descripcion,
							   ':categoria'=>$categorias,
							   ':lloc'=>$lloc,
							   ':imatge'=>$imatge
							 ));
										
		}
		
		public function editarSite($id, $titol, $descripcio,$categoria,$lloc,$imatge){
			
			$id = (int) $id;
			$categorias = (int) $categoria;
			
			if(!$imatge){
				
				$this->_db->prepare("UPDATE Sites SET titol = :titol, descripcio = :descripcio, categoria = :categoria, lloc = :lloc,  data = now()  WHERE id_site = :id")
				->execute(
				
						array(
						   ':id'=>$id,
						   ':titol' => $titol,
						   ':descripcio' => $descripcio,
						   ':categoria' => $categorias,
						   ':lloc'=>$lloc
						   
						   
						));

				
			
			}else{
			
				$this->_db->prepare("UPDATE Sites SET titol = :titol, descripcio = :descripcio, categoria = :categoria, lloc = :lloc, imatge = :imatge, data = now()  WHERE id_site = :id")
						->execute(
						
								array(
								   ':id'=>$id,
								   ':titol' => $titol,
								   ':descripcio' => $descripcio,
								   ':categoria' => $categorias,
								   ':lloc'=>$lloc,
								   ':imatge'=>$imatge
								   
								));
			}
							
		
		}
				
		public function PublicarComentari($comentari){
		
			$this->_db->prepare("INSERT INTO Comentaris VALUES(null, :comentari, now())")
						
						->execute(array(':comentari' =>$comentari));				
		
		}
		
		
		public function UltComentari(){
	
			$comentari = $this->_db->query("SELECT * FROM Comentaris ORDER BY id_comentari DESC LIMIT 1 ");
									
			return $comentari->fetch();
		
		}
		
		public function AsociarComentari($usuari, $ultComentari, $id){
		
			
			$this->_db->prepare("INSERT INTO SitesComentaris VALUES($id, $ultComentari)")->execute();
			
			$this->_db->prepare("INSERT INTO UsuarisComentaris VALUES($usuari, $ultComentari)")->execute();
		
		}
		
		public function UltSiteInsert(){
		
			$site = $this->_db->query("SELECT * FROM Sites ORDER BY id_site DESC LIMIT 1");
			
			return $site ->fetch();
		
		}
		
		public function getidMultimedia($id){
		
			$multimedia = $this->_db->query("SELECT * FROM Multimedia WHERE site = $id ORDER BY id_multimedia ASC LIMIT 1");
			
			return $multimedia ->fetch();
		
		}
		
		public function ImgsSites($imatges, $ultsite){
				
			$ultsite = (int) $ultsite;
								
			$user = (int) Session::get('id_usuari');
			
			$this->_db->prepare("INSERT INTO Multimedia VALUES(null,:imatge,null,$user,$ultsite,null)")
							
							->execute(
								
								array(
									':imatge' => $imatges
									)
								);
		
			
		
		}
		
		public function UpdateImgsSites($multimedia,$imatges, $id){
			
			$id = (int) $id;
			$multimedia = (int) $multimedia;
			
			if(!$imatges){
			
			
			}else{
			
				$this->_db->prepare("UPDATE Multimedia SET imatge = :imatge WHERE id_multimedia = $multimedia AND site = $id")
								
								->execute(
									
									array(
									
										':imatge' => $imatges
									
									)
								
								);
			}
		
		}

	}

?>
