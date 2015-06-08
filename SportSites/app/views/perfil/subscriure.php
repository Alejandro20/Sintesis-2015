<section>
<?php if(Session::get('autenticat')):?>
<div class="titol">Donar D'alta Subscriptor</div>


<div class="contenedor_centro">

	<form name="form1" method="post" action="" >
                     <input type="hidden" name="guardar" value="1" />
               
                  <div class="pagament">
                        <div>
                  			<label>Metode de pagament: </label><select name="metodePagament" required> 
                        		<option value="Tarjeta">Tarjeta</option>
                        		<option value="Transferencia">Transferencia</option>
                                <option value="Pay Pal">PayPal</option>
                    		</select>
                            
                            <label>Preu: </label><input type="text" name="preu_subscripcio" disabled="disabled" value="2€"/>
                        </div>
                        	
                        <div class="compte_bancari">
                        	<label>Compte bancari: </label><input type="text" name="c_bancaria" value="<?php if(isset($this->dades['c_bancaria'])) echo $this->dades['c_bancaria']; ?>" />
                        </div>
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






