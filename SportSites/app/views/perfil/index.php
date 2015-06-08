<section>
<?php if(Session::get('autenticat')):?>
<?php 

	$usuari = Session::get('usuari');
	$id_user = Session::get('id_usuari');
	?>
    
	<div class="titol">Gestio de l'usuari <?php echo $usuari ?>:</div>
	
<div class="cont_perfil">


    <div><a href="<?php echo BASE_URL.'perfil/editar/'.$id_user;?>"><input type="button" value="Editar Perfil"></a></div>
    
    <?php if(Session::get('subscrit')=='NO' && Session::get('admin') != 1):?>
    	
    	<div><a href="<?php echo BASE_URL.'perfil/Subscriure/'.$id_user;?>"><input type="button" value="Subscriure"></a></div>
    
	<?php elseif(Session::get('subscrit')=='SI' && Session::get('admin') != 1): ?>
    	
        <div class="cont_subscripcio"><a href="<?php echo BASE_URL.'perfil/BaixaSubscripcio/'.$id_user;?>"><input type="button" value="Cancelar Subscripcio"></a></div>
    
    <?php endif; ?>
    
   	<div><a href="<?php echo BASE_URL.'sites/propis';?>"><input type="button" value="Els meus Llocs"></a></div>
    
    
    <?php if(Session::get('admin')==1):?>
    	
    	<div><a href="<?php echo BASE_URL.'administrador';?>"><input type="button" value="Administrador"></a></div>
    
	<?php endif ?>
    
    	
</div>

<?php else: 
     
     	header("Location:".BASE_URL."login/index.php");
	 
	 endif; ?>	
	
</section>

