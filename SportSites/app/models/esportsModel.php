<?php
/**
* Tindrem totes les funcions que es pot fer en la finestra de les categories (esports)
*
* @author SportSites 
* @param  getCategories obtindrem les categories que tenim a la pagina
* @param  getCategoria obtindrem la categoria en concret.
* @param  getCategoriaInsert serveix per saber la ultima categoria que hem inserit
* @param  insertEsport serveix per insertar un sport
* @param  insertImgEsport serveix per poder insertar imatges als esports
* @param  UpdateEsport serveix per poder editar i pujar els esports que tenim a la pagina
* @param  UpdateImgEsport serveix per poder pujar les imatges dels esports
*
*/
class esportsModel extends Model{
	
    public function __construct(){
        
		parent::__construct();
		
    }
	
	public function getCategories(){
	
		$esports = $this->_db->query("SELECT * FROM VCategories");
		
		 return $esports->fetchall();
	}
	
	public function getCategoria($id){
		
		$id = (int) $id;
	
		$esport = $this->_db->query("SELECT * FROM Categories WHERE id_categoria = $id");
		
		return $esport->fetch();
	}
	
	public function getCategoriaInsert(){
	
		$esport = $this->_db->query("SELECT * FROM Categories ORDER BY id_categoria DESC LIMIT 1 ");
		
		return $esport->fetch();
	}
	
	public function insertEsport($nom, $descripcio){
			
						
			$this->_db->prepare("INSERT INTO Categories VALUES(null, :nom, :descripcio)")
						->execute(
							
								array(
								
							   		':nom' => $nom,
							   		':descripcio' => $descripcio
									
							 	));
										
	}
	
	
	public function UpdateEsport($id,$nom, $descripcio){
	
		$id = (int) $id;
		
		$this->_db->prepare("UPDATE Categories SET nom = :nom, descripcio = :descripcio WHERE id_categoria = :id")
					->execute(
					
							array(
							
							   ':id'=>$id,
							   ':nom' =>$nom,
							   ':descripcio' =>$descripcio							   
							   
							));
	
	}
	
	public function UpdateImgEsport($imatge, $categoria){
		
		if(!$imatge){
		
		}else{		
		
			$categoria = (int) $categoria;
		
			$this->_db->prepare("UPDATE Multimedia SET imatge = :imatge WHERE categoria = :categoria")
								
								->execute(
									
									array(
									
										':imatge' => $imatge,
										':categoria' => $categoria
									
									));
		}
	
	}
	

}

?>