<section>
<?php if(Session::get('autenticat')):?>
<div class="titol"> Administrador d'Esports:</div>

<div class="contenedor">

	<?php if(Session::get('autenticat')):
        
        if(isset($this->administradorCategories) && count($this->administradorCategories)) : ?>
    
            <table>
            
                <tr>
                    <th>NOM</th>
                    <th>Descripcio</th>
                    <th>IMATGE</th>   
                </tr>
                
                <?php for($i = 0; $i < count($this->administradorCategories); $i++): ?>
                
                <tr>
                    <td><?php echo $this->administradorCategories[$i]['nom']; ?></td>
                    <td><?php echo $this->administradorCategories[$i]['descripcio']; ?></td>
                    
                    <?php if(!$this->administradorCategories[$i]['imatge']): ?>
                    	
                        <td id="cat_admin"><img class="img_site" id="cat_admin" src="<?php echo BASE_URL.IMG_ESPORTS.NO_IMATGE?>"></td>
                    
					<?php else: ?>
                    
                    	<td id="cat_admin"><img class="img_site" id="cat_admin" src="<?php echo BASE_URL.IMG_ESPORTS.$this->administradorCategories[$i]['imatge']?>"></td>
                        
                   <?php endif; ?>
                    
                    
                    <td><a class="button" href="<?php echo BASE_URL.'esports/editarCategoria/'.$this->administradorCategories[$i]['categoria'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'edit.png'?>" /></a>  <a class="button" href="<?php echo BASE_URL.'administrador/eliminarCategoria/'.$this->administradorCategories[$i]['categoria'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'delete.png'?>" /></a></td> 
    
                </tr>
                
                <?php endfor;?>
                
            </table>

        <?php else: ?>
    
            <h2>No hi han Categories!</h2>
    
    	<?php endif;?> 
        
        
    
    <?php endif; ?>


</div>

<div class="contenedor_links">
               
      		<a href="<?php echo BASE_URL.'esports/nou';?>">Afegir Esport</a>
                    
        	</div>
            
             <?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?> 

			

</section>