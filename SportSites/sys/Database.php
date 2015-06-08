<?php
/**
* Aqui tenim la configuracio per poder entrar a la base de dades, osigui la comunicacio
*
* @author SportSites
* @param Database serveix per poder entrar a la base de dades reben els parametres per el config.php
*/
class Database extends PDO{
	
    public function __construct() {
        parent::__construct(
                'mysql:host=' . DB_HOST .';dbname=' . DB_NAME, DB_USER, DB_PASS, 
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR
                )
		);
                
    }
}

?>
