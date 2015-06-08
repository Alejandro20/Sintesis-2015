<?php

/**
* Core de la app
*
* @author SportSites
* @param tanca serveix tancar la sessio
* @param set serveixen per poder enviar i rebre les sessions i controlarles
* @param get serveixen per poder enviar i rebre les sessions i controlarles
* @param temps serveix per definir el temps de sessio
*/
class Session{
	
    public static function inicia(){
		
        session_start();
    
	}
    
    public static function tanca($clau = false)
    {
        if($clau){
			
            if(is_array($clau)){
				
                for($i = 0; $i < count($clau); $i++){
					
                    if(isset($_SESSION[$clau[$i]])){
						
                        unset($_SESSION[$clau[$i]]);
						
                    }
					
                }
				
            }else{
                
				if(isset($_SESSION[$clau])){
					
                    unset($_SESSION[$clau]);
					
                }
				
            }
			
        }else{
			
            session_destroy();
        }
    }
    
    public static function set($clau, $valor)
    {
        if(!empty($clau))
		
        	$_SESSION[$clau] = $valor;
    }
    
    public static function get($clau){
		
        if(isset($_SESSION[$clau]))
		
            return $_SESSION[$clau];
			
    }
    
    
    public static function temps()
    {
        if(!Session::get('tiempo') || !defined('SESSION_TIME')){
			
            throw new Exception('No se ha definit el tiemps de sessio'); 
			
        }
        
        if(SESSION_TIME == 0){
			
            return;
			
        }
        
        if(time() - Session::get('tiempo') > (SESSION_TIME * 60)){
            
			Session::tanca();
            header('location:' . BASE_URL . 'error/access/8080');
			
        }else{
            
			Session::set('tiempo', time());
        
		}
    
	}

}

?>