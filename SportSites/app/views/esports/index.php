<section>

    <div class="titol">Esports: </div>
    
    <div class="contenedor_sites">
    
            <?php if(isset($this->esports) && count($this->esports)) : ?>
    
                <?php for($i = 0; $i < count($this->esports); $i++): ?>
                    
                    <?php if(!$this->esports[$i]['imatge']): ?>
                    
                        <div class="sites">
                        
                            <a style="width:100%;" href="<?php echo BASE_URL.'sites/filtrat/'.$this->esports[$i]['nom'];?>"><img class="img_site" src="<?php echo BASE_URL.IMG_ESPORTS.NO_IMATGE?>" alt="Sense Imatge"/></a>
                            
                            <div class="contenedor_centro_iconos">
                    			
                                <div class="titol_site"><?php echo $this->esports[$i]['nom'];?></div>
                    		
                            </div>

                        </div>
                    
                    <?php else: ?>
                    
                    
                        <div class="sites">
                        
                            <a style="width:100%;" href="<?php echo BASE_URL.'sites/filtrat/'.$this->esports[$i]['nom'];?>"><img src="<?php echo BASE_URL.IMG_ESPORTS.$this->esports[$i]['imatge']?>" alt="<?php echo $this->esports[$i]['nom'];?>"/></a>
                            
                            <div class="contenedor_centro_iconos">
                    
                    			<div class="titol_site"><?php echo $this->esports[$i]['nom'];?></div>
                    		
                            </div>

                        </div>
                    
                     <?php endif ?>
                    
                
                <?php endfor;?>
                 
    </div>   

        <?php endif; ?>

     
       
	
     

     
</section> 
