<section>
<?php if(Session::get('autenticat')):?>
<div class="titol">Afegeix un Nou Site:</div>

<form id="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="guardar" value="1" />
    
  	<div class="contenedor_column">  
        
            <label>Titol:</label><input type="texto" name="titol" value="<?php if(isset($this->dades)) echo $this->dades['titol']; ?>"/>
        
        
            <label>Descripcio:</label><textarea name="descripcio"><?php if(isset($this->dades)) echo $this->dades['descripcio']; ?></textarea>
        
        
        
        	<label>Categoria:</label><select name="categoria">
            			<option value="0"><label>Seleccioni una Categoria</label></option>
                    	<?php for($i = 0; $i < count($this->categories); $i++): ?>
                       
                        
                        	<option value="<?php if(isset($this->categories)) echo $this->categories[$i]['id_categoria']; ?>"><?php if(isset($this->categories)) echo $this->categories[$i]['nom']; ?></option>
                            
                            
                         
                    <?php endfor;?>
                 </select>
                 
                 
        
            <label>Lloc:</label><input type="texto" name="lloc" value="<?php if(isset($this->dades)) echo $this->dades['lloc']; ?>" />
        
			<div id="imatges">
            
            	<label>Imatge Principal:</label><input id="input_img" type="file" name="imatge" /><br/>
            
            </div>
            
            <input type="button" id="add_img_insert" value="Afegir Imatge"/>
        
        
			<div class="registrarse">
            
        		<input type="submit" class="button" value="Guardar" />
                
            </div>
    
    
 


</form>

</div> 

<?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?>
     
      <script>
            
		$(document).ready(function(){
			
								
			cont_imatges = 0;
			
			/*Funcio afegir inputs en vista de Nou Lloc*/
			
			$("#add_img_insert").click(function(){
				
				cont_imatges ++;
				
				if(cont_imatges < 5){
		
				$("#imatges").append("<label>Imatge " + cont_imatges + ":</label><input id='input_img' type='file' name='imatges[]' /><br/>");
				
				}else if(cont_imatges >=5){
				
					alert("No es poden insertar mes imatges");
				
				}
		
			});
		});
				
	</script>

</section>