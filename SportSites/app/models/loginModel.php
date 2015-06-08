<?php
/**
* Tindrem totes les funcions que es pot fer en la finestra dels logins
*
* @author SportSites 
* @param  getUsuario obtindrem el usuari per poder loguejarnos amb els parametres d'entrada
* @param  getSubscripcio mirarem la subscripcio dels usuaris que estan subcrits
*
*/

class loginModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getUsuario($usuari, $password){
        
		$login = $this->_db->query("SELECT * FROM Usuaris WHERE usuari = '$usuari' and password = '$password'");
        
        return $login->fetch();
    
	}
	
	public function getSubscripcio(){
	
		$usuari = Session::get('id_usuari');

		$subscripcio = $this->_db->query("SELECT * FROM Subscripcio WHERE usuari = $usuari");
		
		return $subscripcio->fetch();
		
	}
	
}

?>
