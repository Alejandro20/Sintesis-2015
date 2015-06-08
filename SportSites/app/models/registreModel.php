<?php
/**
* Tindrem totes les funcions que el registre necesitem
*
* @author SportSites
* @param  verificarUsuari serveix per verificar els usuaris
* @param  verificarEmail serveix per verificar els emails
* @param  registrarUsuari serveix per poder registrar els usuaris a la pagina
* @param  getUsuari serveix per poder obtenir el usuari
*/
class registreModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function verificarUsuari($usuario){
        
		$id = $this->_db->query("SELECT id_user FROM Usuaris WHERE usuari = '$usuario'" );
        
        return $id->fetch();
		
    }
    
    public function verificarEmail($email){
		
        $id = $this->_db->query("SELECT id_user FROM Usuaris WHERE email = '$email'");
        
        if($id->fetch()){
            
			return true;
        
		}
        
        return false;
    }
    
    public function registrarUsuari($nom,$cognoms,$localitat,$sexe,$telefon, $email, $usuari, $password, $imatge){
    	
		
        $this->_db->prepare(
                "INSERT INTO Usuaris VALUES" .
                "(null, :nom, :cognom, :localitat, :sexe, :telefon, :email, :usuari, :password, 2, 1, :imatge, 0)"
                )
                ->execute(array(
                    ':nom' => $nom,
					':cognom'=>$cognoms,
					':localitat'=> $localitat,
					':sexe'=>$sexe,
					':telefon'=>$telefon,
                    ':email' => $email,
                    ':usuari' =>$usuari,
                    ':password' => $password,
					':imatge'=>$imatge
                    
                ));
				
    }
    
    public function getUsuari($id){
		
		$usuario = $this->_db->query("SELECT * FROM Usuaris WHERE id_user = $id ");
					
		return $usuario->fetch();
		
	}
	
	
}

?>
