<?php
/**
* Core de la app
*
* @author SportSites
* @param iniciar serveix per iniciar la app, sense el core no funcionaria res
*/
class Core
{
    public static function iniciar(Request $peticio)
    {
        $controller = $peticio->getControlador() . 'Controller';
        $rutaControlador = ROOT .'app' . DS . 'controllers' . DS . $controller . '.php';
        $metode = $peticio->getMetode();
        $args = $peticio->getArgs();
        
        if(is_readable($rutaControlador)){
			
            require_once $rutaControlador;
            $controller = new $controller;
            
            if(is_callable(array($controller, $metode))){
                $metode = $peticio->getMetode();
            }
            else{
                $metode = 'index';
            }
            
            if(isset($args)){
                call_user_func_array(array($controller, $metode), $args);
            }
            else{
                call_user_func(array($controller, $metode));
            }
            
        } else {
            throw new Exception('No es troba aquesta peticio a la aplicacio');
        }
    }
}

?>