<section>

    <div class="titol">Llocs de <?php echo Session::get('categoria');?>:</div>
    
    <div><p class="descripcio_esport"><?php echo $this->categoria['descripcio'];?></p></div>
    
    <div class="contenedor_sites">

        <?php if(Session::get('autenticat')):
        
            if(isset($this->llocs) && count($this->llocs)) : ?>
    
                <?php for($i = 0; $i < count($this->llocs); $i++): ?>
                    
                    <?php if(!$this->llocs[$i]['imatge']): ?>
                    
                        <div class="sites">
                        
                            <a href="<?php echo BASE_URL.'sites/site/'.$this->llocs[$i]['id_site'];?>"><img class="img_site" src="<?php echo BASE_URL.IMG_SITES.NO_IMATGE?>" alt="Sense Imatge"/></a>
                            
                            <div class="contenedor_centro_iconos">
                    			
                                <div class="titol_site"><?php echo $this->llocs[$i]['titol'];?></div>
                                <a id="icon" href="<?php echo BASE_URL.'sites/favorit/'.$this->llocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'favorit.png'?>" alt="Afegir a Favorits"/></a>
                                
                            </div>
        
                        </div>
                        
                    
                    <?php else: ?>
                    
                    
                        <div class="sites">
                        
                                <a href="<?php echo BASE_URL.'sites/site/'.$this->llocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.IMG_SITES.$this->llocs[$i]['imatge']?>" alt="<?php echo $this->llocs[$i]['titol'];?>"/></a>
                                
                                <div class="contenedor_centro_iconos">
                    				<div class="titol_site"><?php echo $this->llocs[$i]['titol'];?></div>
                                    <a id="icon" href="<?php echo BASE_URL.'sites/favorit/'.$this->llocs[$i]['id_site'];?>"><img src="<?php echo BASE_URL.ICON_SITES.'favorit.png'?>" alt="Afegir a Favorits"/></a>
                                    
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
    
			<?php else: 
         
            	header("Location:".BASE_URL."login/index.php");
         
            endif; ?>
     

     
</section> 

  
     

  
 