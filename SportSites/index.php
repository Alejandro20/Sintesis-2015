<?php

	ini_set('display_errors', 'on');
	require 'constants.php';

	Session::inicia();
				
	Core::iniciar(new Request);

?>