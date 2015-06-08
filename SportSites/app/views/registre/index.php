<section>

    <div class="titol">Registre</div>
    
    
        <div class="contenedor">
        
        <div class="form_registre">
            <form method="post" action="" >
            
                <input type="hidden" value="1" name="Registrarse" />
                
                <input type="text"  placeholder="Nom" value="<?php if(isset($this->datos)) echo $this->datos['nom']; ?>"  name="nom" required title="Introdueix el teu Nom">
                <input type="text"  placeholder="Cognoms" value="<?php if(isset($this->datos)) echo $this->datos['cognoms']; ?>"  name="cognoms" required title="Introdueix el teus cognoms">
                <input type="text"  placeholder="Localitat" value="<?php if(isset($this->datos)) echo $this->datos['localitat']; ?>" name="localitat" required title="Especifica la teva localitat">
                <input type="text"  placeholder="Telefon" value="<?php if(isset($this->datos)) echo $this->datos['telefon']; ?>"  name="telefon" required title="Introdueix un nom de contacte">
                
                    <label>Sexe : </label><select name="sexe" required title="Indica el teu Sexe"> 
                        <option value="Dona">Dona</option>
                        <option value="Home">Home</option>
                    </select>
		</div>
            
            
            <div class="form_registre">
                <input type="text"  placeholder="Email" value="<?php if(isset($this->datos)) echo $this->datos['email']; ?>"  name="email" required title="Introdueix un Email">
                <input type="text"  placeholder="Nom d'usuari" value="<?php if(isset($this->datos)) echo $this->datos['usuari']; ?>" name="usuari" required title="Introdueix un nom d'Usuari">
                <input type="password"  placeholder="Password" name="pass" required title="Introduix una Contrasenya">
                <input type="password"  placeholder="Repetir Password" name="confirmar" required title="Sisplau Confirmi la contrasenya">
			</div>
        
        </div>
        
        
        
    
    <div class="subscripcio" align="center">
        	            
        	<div class="registrarse">
                <input type="submit" value="Registrarse">
            </div>
            
            <div class="subscripcio_hidden"></div>
            
            <div class="texto2">Registran-te acceptes els termes del <a href="#">servei</a> i la <a href="#">política de privacitat</a></div>
        	
        </form> 
           
    </div>
    
   

</section>