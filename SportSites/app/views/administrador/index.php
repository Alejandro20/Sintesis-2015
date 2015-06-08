<section>
	<?php if(Session::get('autenticat')):?>
       
        <?php 
            $usuari = Session::get('usuari');
            $id_user = Session::get('id_usuari');
        ?>
        
        <div class="titol">Portal de l'Administrador: <?php echo $usuari ?></div>
        
        <div class="cont_perfil">
    
    
            <div><a href="<?php echo BASE_URL.'administrador/usuaris'?>"><input type="button" value="Administrar Usuaris"></a></div>
            
           <div><a href="<?php echo BASE_URL.'administrador/llocs';?>"><input type="button" value="Administrar LLocs"></a></div>
            
           <div><a href="<?php echo BASE_URL.'administrador/categories';?>"><input type="button" value="Administrar Categories"></a></div>
            
        </div>	
        
        <?php else: 
         
            header("Location:".BASE_URL."login/index.php");
         
         endif; ?> 
	
</section>
