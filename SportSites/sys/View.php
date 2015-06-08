<?php
/**
* Core de la app
*
* @author SportSites
* @param carrega serveix per poder tenir les vistes carregades, de manera que podrem veure el menu, tant si estem autenticat de una manera de administrador o usuaris normals
* @param setJs sreveix per carregar javascript
* @param View serveix per poder carregar la vista
*/
class View
{
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticio){
		
        $this->_controlador = $peticio->getControlador();
        $this->_js = array();
		
    }
    
    public function carrega($vista, $item = false){
		
        $menu = array(
		
            array(
                'id' => 'inici',
                'titulo' => 'Inici',
                'enlace' => BASE_URL
                ),
				
			array(
                'id' => 'esports',
                'titulo' => 'Esports',
                'enlace' => BASE_URL.'esports'
                ),
	
        );
		
		
		
		
		$menu2 = array();
		
        
        if(Session::get('autenticat')){
			
			if(Session::get('admin') == 1){
				
				$menu2[] = array(
					
					'id' => 'administrador',
					'titulo' => 'Administrar',
					'enlace' => BASE_URL . 'administrador'
					
                );
				
				$menu[] = array(
						'id' => 'sites',
						'titulo' => 'LLocs',
						'enlace' => BASE_URL . 'sites'
					);
				
			}else{
				
				$menu[] = array(
						'id' => 'sites',
						'titulo' => 'LLocs',
						'enlace' => BASE_URL . 'sites'
					);
					
			}
				
            
			
			$menu2[] = array(
					'id' => 'perfil',
					'titulo' => "Compte d'usuari",
					'enlace' => BASE_URL . 'perfil'
                );
				
			$menu2[] = array(
					'id' => 'login',
					'titulo' => 'Tanca Sessio',
					'enlace' => BASE_URL . 'login/tancar'
                );
				
        }else{
			
			$menu2[]= array(
						'id' => 'login',
						'titulo' => 'Inicia Sessio',
						'enlace' => BASE_URL . 'login'			
						);
	
			$menu2[] = array(
				
				
					'id' => 'registre',
					'titulo' => 'Registrar',
					'enlace' => BASE_URL . 'registre'
				
			
			);
		
		}
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $_layoutParams = array(
		
            'ruta_css' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
			'menu2' => $menu2,
            'js' => $js
			
        );
        
        $rutaView = ROOT . 'app' . DS. 'views' . DS . $this->_controlador . DS . $vista . '.php';
        
        if(is_readable($rutaView)){
			
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
			
        }else{
			
            throw new Exception('Error de vista');
        
		}
    
	}
    
    public function setJs(array $js){
		
        if(is_array($js) && count($js)){
			
            for($i=0; $i < count($js); $i++){
				
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
            }
			
        }else{
			
            throw new Exception('Error de js');
        
		}
    
	}

}

?>
