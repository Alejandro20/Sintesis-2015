<!doctype html>
    <html>
    
        <head>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            
            <title><?php echo $this->titol?></title>
            
            <link href="<?php echo BASE_URL.ICON_SITES.'favicon.png' ?>" rel="icon" type="image/x-icon" />
            
                        
            <link href="<?php echo $_layoutParams['ruta_css']; ?>style.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo $_layoutParams['ruta_css']; ?>responsive.css" rel="stylesheet" type="text/css"/>
			
            <script src="<?php echo $_layoutParams['ruta_js'];?>JQuery-Libreria.js"></script>
            <script src="http://maps.googleapis.com/maps/api/js"></script>
            
        </head>
                
        <body>
        
              <header>

                <nav>
                	                    
                    <div id="menu-icon"></div>
                      
                       <div class="submenu">
                       
                       <div id="logo"><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL.ICON_SITES.'logo_menu.png'?>" alt="logo"></a></div>
                       
                        <?php if(isset($_layoutParams['menu'])): ?>
                        
                   
                            <?php for($cont_menu = 0; $cont_menu < count($_layoutParams['menu']); $cont_menu++): ?>
                             
                                <?php 
        
                                    if($item && $_layoutParams['menu'][$cont_menu]['id'] == $item ){ 
                                    
                                        $_item_style = 'current'; 
                                    
                                    }else{
                                        
                                        $_item_style = '';
                                        
                                    }
        
                                ?>
                                 
                               <li class="elementos_menu" id="<?php echo 'menu_'.$cont_menu ?>" ><a class="<?php echo $_item_style; ?>" href="<?php echo $_layoutParams['menu'][$cont_menu]['enlace']; ?>"><?php  echo $_layoutParams['menu'][$cont_menu]['titulo']; ?></a></li>
        
                            <?php endfor; ?>
                        
                        <?php endif; ?>
                        
                    </div>
                </nav>
            
                <div class="espacio"></div>
                
                <div class="acces">
                    
                    <?php if(isset($_layoutParams['menu2'])): ?>
                                
                        <?php for($cont_menu_2 = 0; $cont_menu_2 < count($_layoutParams['menu2']); $cont_menu_2++): ?>
                        
                            <?php 
    
                                if($item && $_layoutParams['menu2'][$cont_menu_2]['id'] == $item ){ 
                                
                                    $_item_style = 'current'; 
                                
                                }else{
                                    
                                    $_item_style = '';
                                    
                                }
    
                            ?>
    
                            <div><a class="<?php echo $_item_style; ?>" href="<?php echo $_layoutParams['menu2'][$cont_menu_2]['enlace']; ?>"><?php  echo $_layoutParams['menu2'][$cont_menu_2]['titulo']; ?></a></div>
    
                        <?php endfor; ?>
                        
                    <?php endif; ?>
                    
                </div>
                
                
                <script>
				
					$(document).ready(function(){
						
							$("#menu-icon").click(function(){
							
							
								$(".submenu").fadeToggle();
							
							});
                        
                    });
				
				</script>

            </header>
            
            <?php if(isset($this->_error)):?>
            
				<div id="errors">
                
                	<h3>Errors:</h3>
                    
                    <?php for ($cont_errors = 0; $cont_errors < count($this->_error); $cont_errors ++):?>
                    	
                        <div id="error"><?php echo $this->_error[$cont_errors]; ?></div>
                        
                    <?php endfor;?>    
                
                </div>
			
			<?php endif;?>
