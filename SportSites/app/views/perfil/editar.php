<section>

	<?php if(Session::get('autenticat')):?>
	<div class="titol">Edita tu Perfil:</div>
	
        <div class="contenedor">
            
            <div class="form_editar_perfil">
            
                <form name="form1" method="post" action="" enctype="multipart/form-data" >
                     <input type="hidden" name="guardar" value="1" />
                            
                            <label>Nom:</label>
                            <input type="text" name="nom" value="<?php if(isset($this->dades['nom'])) echo $this->dades['nom']; ?>" />
                            
    
                            
                            <label>Cognoms: </label>
                            <input type="text" name="cognoms" value="<?php if(isset($this->dades['cognoms'])) echo $this->dades['cognoms']; ?>" />
                            

                            
                            <label>Telefon:</label>
                            <input type="text" name="telefon" value="<?php if(isset($this->dades['telefon'])) echo $this->dades['telefon']; ?>" />
                            
                     
                            <label>Imatge:</label>
                            <input type="file" name="imatge" value="<?php if(isset($this->dades)) echo $this->dades['imatge_perfil']; ?>" />

                    </div>

                    <div class="form_editar_perfil">
    
                            
                            <label>Usuari:</label>
                            <input disabled type="text" name="usuari" value="<?php if(isset($this->dades['usuari'])) echo $this->dades['usuari']; ?>" />
                            
                  			<label>Email:</label>
                            <input type="text" name="email" value="<?php if(isset($this->dades['email'])) echo $this->dades['email']; ?>" />
                            
                            <label>Password:</label>
                            <input type="password" name="pass" />
                            
                      
                            
                            <label>Confirmar:</label>
                            <input type="password" name="confirmar" />
                       
                        
							<?php if(Session::get('admin')==1):?>
                        
                           
                                    
                                    <label>Rol Usuari: </label>
                                    <input type="text" name="rol" value="<?php if(isset($this->dades['rol'])) echo $this->dades['rol']; ?>" />
                                
                        
                        	<?php endif ?>
                
                
     					</div>
        
     			 </div>

                 <div align="center" class="registrarse">       
      				<input type="submit" value="Guardar" class="button" />
                 </div>  

            </form>
      	
   <?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?>      
       

</section>