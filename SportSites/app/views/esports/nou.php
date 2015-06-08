<section>

    <div class="titol">Afegeix un Nou Esport:</div>
    
        <form id="form1" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="guardar" value="1" />
            
          <div class="contenedor_column">  
                
                    <label>Esport:</label><input type="texto" name="nom" value="<?php if(isset($this->dades)) echo $this->dades['nom']; ?>" />
                
                    <label>Descripcio:</label><textarea name="descripcio"><?php if(isset($this->dades)) echo $this->dades['descripcio']; ?></textarea>
                
                    <label>Imatge:</label><input id="input_img" type="file" name="imatge" value="<?php if(isset($this->dades)) echo $this->dades['imatge']; ?>" />
                
                
                    <div class="registrarse">
                    
                        <input type="submit" class="button" value="Guardar" />
                        
                    </div>
        
        </form>
    
    </div> 

</section>