<section>

    <div class="contenedor_centro">
    
        <form name="form1" method="post" action="" class="form_login">
                   
           <h2>SPORTSITES!!</h2>
           
          <input type="text" name="usuario" value="<?php if(isset($this->datos)) echo $this->datos['usuario']; ?>" placeholder="Nom d'usuari" required title="Introdueix un nom d'usuari"/>
            
    
          <input type="password" name="pass" placeholder="Contrasenya" required title="Introdueix la contrasenya."/>
    
    
          <div class="boto">
            <input type="submit" value="Som-hi!" class="boto"/>
            <input type="hidden" value="1" name="enviar" />
          </div>
         
          
    
        </form>
        
    </div>
    
    <div class="texto2" align="center">No tens compte creada i vols accedir? <a href="<?php echo BASE_URL.'registre/';?>">Registrarse</a></div>

</section>