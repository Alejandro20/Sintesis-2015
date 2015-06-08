<section>
<?php if(Session::get('autenticat')):?>
<div class="titol">Administracio De Llocs: </div>

<div class="contenedor_sites">

	<?php if(Session::get('autenticat')):
    
	 	if(isset($this->administradorLlocs) && count($this->administradorLlocs)) : ?>

            <?php for($i = 0; $i < count($this->administradorLlocs); $i++): ?>
                
                <?php if(!$this->administradorLlocs[$i]['imatge']): ?>
                
                <div class="sites">
                
                	<a href="<?php echo BASE_URL.'sites/site/'.$this->administradorLlocs[$i]['id_site'];?>"><img class="img_site" src="<?php echo BASE_URL.IMG_SITES.NO_IMATGE?>"></a>
                    <div class="contenedor_centro_iconos">
                    	<div class="titol_site"><?php echo $this->administradorLlocs[$i]['titol'];?>hhhh</div>
                    	<a id="icon" href="<?php echo BASE_URL.'sites/editar/'.$this->administradorLlocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'edit.png'?>" /></a>
                    	<a id="icon" href="<?php echo BASE_URL.'administrador/eliminarSite/'.$this->administradorLlocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'delete.png'?>" /></a>
                    </div>

                </div>
                
                <?php else: ?>
                
                
                <div class="sites">
                
                	<a href="<?php echo BASE_URL.'sites/site/'.$this->administradorLlocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.IMG_SITES.$this->administradorLlocs[$i]['imatge']?>"></a>
                    
                    <div class="contenedor_centro_iconos">
                    
                    	<div class="titol_site"><?php echo $this->administradorLlocs[$i]['titol'];?></div>
                        
                    	<a id="icon" href="<?php echo BASE_URL.'sites/editar/'.$this->administradorLlocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'edit.png'?>" /></a>
                        
                    	<a id="icon" href="<?php echo BASE_URL.'administrador/eliminarSite/'.$this->administradorLlocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'delete.png'?>" /></a>
                    
                    </div>
                    
                </div>
                
                 <?php endif ?>
                
            
            <?php endfor;?>
             
</div>   

        <?php else: ?>
        
            <div class="contenedor_centro">
            
                <div class="titol">No tens cap lloc!</div>
                
            </div>
        
        <?php endif; ?>

     <?php else: ?>
     
         <div class="contenedor_centro">
         
            <div class="titol">Inicia sessio per veure els teus llocs</div>
            
         </div>
       
	 <?php endif; ?>
     
     	<div>
        
            <div align="center">
            
                <div class="titol">Fer Backup dels Llocs: </div>
                
                <APPLET ARCHIVE="dist/SportSites.jar" CODE="JApplet_P.class" WIDTH="100%" HEIGHT="auto"></APPLET>
            
            </div>
            
        </div>
     
     <?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?> 
     

     
    </section> 