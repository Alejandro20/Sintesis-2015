<?php
/**
* 
*
* @author SportSites
* @param loadModel serveix per carregar el model
* @param getTexto serveix per poder obtenir texts
* @param getInt serveix per poder obtenir valors en integers
* @param redirecciona serveix per cuan acaba un proces tornar a redireccionar al lloc
* @param filtrarInt serveix per poder filtar per integers, per exemple id users
* @param getPostParam 
* @param getSql serveix per poder fer querys
* @param getAlphaNum serveix per tenir alfanumerics
* @param validarEmail serveix per validar els emails
*/
abstract class Controller
{
    protected $_view;
    
    public function __construct() {
        $this->_view = new View(new Request);
    }
    
    abstract public function index();
    
    protected function loadModel($model)
    {
        $model = $model . 'Model';
        $rutaModel = ROOT . 'app' . DS.  'models' . DS . $model . '.php';
        
        if(is_readable($rutaModel)){
            require_once $rutaModel;
            $model = new $model;
            return $model;
        }
        else {
            throw new Exception('Error de model');
        }
    }
	

    
    
    protected function getTexto($clau)
    {
        if(isset($_POST[$clau]) && !empty($_POST[$clau])){
            $_POST[$clau] = htmlspecialchars($_POST[$clau], ENT_QUOTES);
            return $_POST[$clau];
        }
        
        return '';
    }
    
    protected function getInt($clau)
    {
        if(isset($_POST[$clau]) && !empty($_POST[$clau])){
            $_POST[$clau] = filter_input(INPUT_POST, $clau, FILTER_VALIDATE_INT);
            return $_POST[$clau];
        }
        
        return 0;
    }
    
    protected function redirecciona($ruta = false)
    {
        if($ruta){
			
            header('location:' . BASE_URL . $ruta);
            exit;
			
        }else{
			
            header('location:' . BASE_URL);
            exit;
			
        }
    }

    protected function filtrarInt($int)
    {
        $int = (int) $int;
        
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }
    
    protected function getPostParam($clau)
    {
        if(isset($_POST[$clau])){
            return $_POST[$clau];
        }
    }
    
    protected function getSql($clau)
    {
        if(isset($_POST[$clau]) && !empty($_POST[$clau])){
            $_POST[$clau] = strip_tags($_POST[$clau]);
            
            if(!get_magic_quotes_gpc()){
                $_POST[$clau] = mysql_escape_string($_POST[$clau]);
            }
            
            return trim($_POST[$clau]);
        }
    }
    
    protected function getAlphaNum($clau)
    {
        if(isset($_POST[$clau]) && !empty($_POST[$clau])){
            $_POST[$clau] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clau]);
            return trim($_POST[$clau]);
        }
        
    }
    
    public function validarEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        
        return true;
    }
    
}

?>
