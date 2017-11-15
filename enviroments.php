<?php
 
class MyEnviroment
{

	public $entornos = Array ();
	public $active = NULL;
 
	public function setEnv($dominio, $url, $cdn, $tipo, $db_host, $db_user, $db_pass, $db_name) {
		$entorno = 	Array (
							"dominio" => $dominio,
							"url" => $url,
							"cdn" => $cdn,
							"tipo" => $tipo,
							"db" => Array (
										"host" => $db_host,
										"user" => $db_user,
										"pass" => $db_pass,
										"name" => $db_name
									)
						);
		array_push($this->entornos, $entorno);
	}

	public function findEnv($busqueda) {

	    foreach ($this->entornos as $key => $val) {

	        if ($val['dominio'] === $busqueda) {
		        $this->setEnvActivo ($this->getEnv($key));
		        return;
	        }

	    }
		return;
	}

	public function getEnv($id) {
		return $this->entornos[$id];
	}

	public function setEnvActivo($entorno) {
		$this->active = TRUE;
		/*
		echo "<pre>";
		var_dump($entorno);
		exit;
		*/

		define('_ENV_DOMAIN', $entorno["dominio"]);
		define('_ENV_URL', $entorno["url"]);		
		define('_ENV_CDN', $entorno["cdn"]);		
		define('_ENV_TYPE', $entorno["tipo"]);		

		define('_ENV_DB_HOST', $entorno["db"]["host"]);
		define('_ENV_DB_USER', $entorno["db"]["user"]);
		define('_ENV_DB_PASS', $entorno["db"]["pass"]);
		define('_ENV_DB_NAME', $entorno["db"]["name"]);
	}

}


$entornos = new MyEnviroment;


/* $entornos->setEnv (  'http://localhost', // Dominio
						'http://localhost', // URL
						false, // CDN
						'local', // Tipo (local, development, testing, production)
						'localhost', // Host Base de datos
						'root', // Usuario Base de datos
						'root', // Contraseña Base de datos
						'dontkeepcalm' // Nombre Base de datos
); */



/*******************************************************************************/
/*********************************    Local    *********************************/
/*******************************************************************************/


$entornos->setEnv (		'localhost', // Dominio
						'http://localhost/verbo', // URL
						false, // CDN
						'local', // Tipo (local, development, testing, production)
						'localhost', // Host Base de datos
						'root', // Usuario Base de datos
						'root', // Contraseña Base de datos
						'verbo' // Nombre Base de datos
);



$entornos->setEnv (             '188.166.12.42', // Dominio
                                                'http://188.166.12.42/verbo', // URL
                                                false, // CDN
                                                'development', // Tipo (local, development, testing, production)
                                                'localhost', // Host Base de datos
                                                'root', // Usuario Base de datos
                                                'Paranoya23', // Contraseña Base de datos
                                                'verbo' // Nombre Base de datos
);

/*******************************************************************************/
/********************************* Development *********************************/
/*******************************************************************************/



/*******************************************************************************/
/*********************************   Testing   *********************************/
/*******************************************************************************/



/*******************************************************************************/
/********************************* Production  *********************************/
/*******************************************************************************/

/* $entornos->setEnv (  'http://localhost', // Dominio
						'http://localhost', // URL
						false, // CDN
						'local', // Tipo (local, development, testing, production)
						'localhost', // Host Base de datos
						'root', // Usuario Base de datos
						'root', // Contraseña Base de datos
						'dontkeepcalm' // Nombre Base de datos
); */

/*******************************************************************************/
/******************************** DEFINE ENTORNO *******************************/
/*******************************************************************************/

$entornos->findEnv($_SERVER['HTTP_HOST']); // Busca el entorno

if (is_null($entornos->active)) { // No se encuentra el entorno definido en "enviroments.php"
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'The application environment is not set correctly. I';
	exit(1); // EXIT_ERROR
}


?>
