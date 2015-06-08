<section>
<?php if(Session::get('autenticat')):?>
<div class="titol"><?php if(isset($this->dades)) echo $this->dades['titol']; ?></div>

<div class="contenedor">

	<div class="contenedor_site_individual">
    
    	<div class="img_principal">
        	
			<?php if(!$this->dades['imatge']): ?>
            
            	 <img src="<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>" alt="Sense Imatge" id="principal"/>
            
			<?php else:?>
            
            	<img src="<?php echo BASE_URL.IMG_SITES.$this->dades['imatge'];?>" alt="<?php echo $this->dades['titol'];?>" id="principal"/>
            
            <?php endif;?>
            
        </div>
        
        
        <?php if(isset($this->imatges) && count($this->imatges)) : ?>
        
        <div class="cont_imagenes_pequeña">
        
        	<div class="imagenes">
            
            <?php if(!$this->dades['imatge']): ?>
            
            	 <img src="<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>" alt="Sense Imatge" id="4"/>
            
			<?php else:?>
            
            	<img src="<?php echo BASE_URL.IMG_SITES.$this->dades['imatge'];?>" alt="<?php echo $this->dades['titol'];?>" id="4"/>
            
            <?php endif;?>
            
            </div>
        	
			<?php for($i = 0; $i < count($this->imatges); $i++): ?>
            
				<?php if($this->imatges[$i]['id_multimedia']): ?>
                
                    <div class="imagenes">
                        
                        <?php if(!$this->imatges[$i]['imatge']): ?>
                        
                             <img src="<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>" alt="Sense Imatge" id="<?php echo $i?>"/>
                        
                        <?php else:?>
                        
                            <img src="<?php echo BASE_URL.IMG_SITES.$this->imatges[$i]['imatge'];?>"alt="<?php echo $this->dades['titol'];?>" id="<?php echo $i?>"/>
                        
                        <?php endif;?>
                    
                    </div>
                    
                <?php endif;?>
            
			<?php endfor;?>

    	</div>
		<?php endif;?>
        
    </div>
    
    
    
    <div class="contenedor_site_individual">
    	<div class="informacion">
    	<label>LOCALITAT: </label> <div><?php if(isset($this->dades)) echo $this->dades['lloc']; ?></div>
        <label>DATA: </label> <div><?php if(isset($this->dades)) echo $this->dades['data']; ?></div>
        <label>DESCRIPCIO: </label> <div><?php if(isset($this->dades)) echo $this->dades['descripcio']; ?></div>
        </div>
    </div>
    
</div>


<!-- COMENTARIOS -->
<div class="titol">Comentaris</div>

<div class="cont_comentario">

	
	<div>
    	
        <?php for($i = 0; $i < count($this->comentaris); $i++): ?>
        	
            <p>
            
			<?php if(!$this->comentaris[$i]['img_perfil']): ?>
            
            	<img src="<?php echo BASE_URL.IMG_PERFIL.NO_IMATGE;?>" alt="Sense Imatge"/>
                
			<?php else:?>
            
            	<img src="<?php echo BASE_URL.IMG_PERFIL.$this->comentaris[$i]['img_perfil']?>" alt="Imatge del usuari <?php echo $this->comentaris[$i]['usuari'];?>"/>
                
			<?php endif;?>
			
			<?php echo $this->comentaris[$i]['usuari']. ' ' .'| Publicat el: '.$this->comentaris[$i]['publicat'];?></p>
			
            <p><?php echo $this->comentaris[$i]['comentari'];?></p>
            
		<?php endfor;?>
    
    </div>
    
    <div class="form_comentario">
    <form method="post" action="" enctype="multipart/form-data">
    	<input type="hidden" name="guardar" value="1" />
        
        <textarea name="comentari" placeholder="Deja aqui tus comentarios" ></textarea>
        
        <div class="registrarse">
            
        		<input type="submit" class="button" value="Guardar" />
                
       	</div>
    
    </form>
    </div>

</div>

<?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?>

	 <script>
            
		$(document).ready(function(){
	
			$("#0").click(function(){
							
							<?php for($i = 0; $i < count($this->imatges); $i++): ?>
							
								<?php if(!$this->imatges[$i]['imatge']): ?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>");
									
								
								<?php else:?>
									
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.$this->imatges[0]['imatge'];?>");
									
									
								<?php endif;?>
								
							<?php endfor;?>
						});
						
						$("#1").click(function(){
							
							<?php for($i = 0; $i < count($this->imatges); $i++): ?>
								<?php if(!$this->imatges[$i]['imatge']): ?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>");
									
								
								<?php else:?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.$this->imatges[1]['imatge'];?>");
									
								
								<?php endif;?>
							<?php endfor;?>
							
						});
						
						$("#2").click(function(){
							
							<?php for($i = 0; $i < count($this->imatges); $i++): ?>
								<?php if(!$this->imatges[$i]['imatge']): ?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>");
									
								
								<?php else:?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.$this->imatges[2]['imatge'];?>");
									
								
								<?php endif;?>
							<?php endfor;?>
							
						});
						
						$("#3").click(function(){
							
							<?php for($i = 0; $i < count($this->imatges); $i++): ?>
								<?php if(!$this->imatges[$i]['imatge']): ?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>");
									
								
								<?php else:?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.$this->imatges[3]['imatge'];?>");
									
								
								<?php endif;?>
							<?php endfor;?>
							
						});
						
						$("#4").click(function(){
							
								
								<?php if(!$this->dades['imatge']): ?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.NO_IMATGE;?>");
									
								
								<?php else:?>
								
									$("#principal").attr("src","<?php echo BASE_URL.IMG_SITES.$this->dades['imatge'];?>");
									
								
								<?php endif;?>
							
							
						});
					
					});
            
            </script>

</section>