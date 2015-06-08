<section>
<?php if(Session::get('autenticat')):?>
<div class="titol"> Administrador d'Usuaris:</div>

<div class="contenedor">

	<?php if(Session::get('autenticat')):
        
        if(isset($this->administradorUsuaris) && count($this->administradorUsuaris)) : ?>
    
            <table>
            
                <tr>
                    <th>NOM</th>
                    <th>COGNOMS</th>
                    <th>LOCALITAT</th>
                    <th>SEXE</th>
                    <th>USUARI</th>
                    <th>ROL</th>
                    <th>ESTAT</th>
                </tr>
                
                <?php for($i = 0; $i < count($this->administradorUsuaris); $i++): ?>
                
                <tr>
                    <td><?php echo $this->administradorUsuaris[$i]['nom']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['cognoms']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['localitat']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['sexe']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['usuari']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['rol']; ?></td>
                    <td><?php echo $this->administradorUsuaris[$i]['estat']; ?></td>
                    <td><a class="button" href="<?php echo BASE_URL.'perfil/editar/'.$this->administradorUsuaris[$i]['id_user'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'edit.png'?>" /></a>  <a class="button" href="<?php echo BASE_URL.'administrador/eliminarUsuari/'.$this->administradorUsuaris[$i]['id_user'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'delete.png'?>" /></a><a class="button" href="<?php echo BASE_URL.'administrador/UsuariBanejat/'.$this->administradorUsuaris[$i]['id_user'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'banner.png'?>" /></a><a class="button" href="<?php echo BASE_URL.'administrador/UsuaridesBanejat/'.$this->administradorUsuaris[$i]['id_user'];?>"><img id="icon" src="<?php echo BASE_URL.ICON_SITES.'desbanner.png'?>" /></a></td> 
                    
                    
                        
                </tr>
                
                <?php endfor;?>
                
            </table>
    
        <?php else: ?>
    
            <h2>No hay Usuarios!</h2>
    
    	<?php endif;?> 
    
    <?php endif; ?>


</div>

<?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?> 

</section>