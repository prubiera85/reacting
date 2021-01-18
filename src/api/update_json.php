<?php

    /**
	 *  Recibe datos en un json y lo escribe en el archivo data.json del directorio de trabajo
     * 
     *  Necesita recibir $_POST["data"] y $_POST["path_trabajo"]
     * 
	 */

    require_once("svn.php");

    $online = false;

    // path de trabajo
    // $path_trabajo = $_POST["path_trabajo"];

    $path_trabajo = "cuaderno";

    /**
	 * Obtiene la working copy del libro
	 */

    function getWorkingcopy( $project ){    
        $project .=( substr($project, strlen($project) - 1, 1) ) == "/" ? "" : "/";    
        $project = "../../workingcopy/" . md5($project);    
        return $project;
    }


    if ($online){
        // datos del svn
        $user = $_POST["user"];
        $pass = $_POST["password"];
        $project = $_POST["project"];
        $params_str = '--username '.$user.' --password '.$pass;
        $info_result = '' ; 

        $svn = new Svn();

        // get workingcopy
        $wcopy = getWorkingcopy($project);  // working copy

        // update repo
        $info_update = $svn->up($wcopy,$params_str);
        $info_result .= "<p><pre>" . $info_update[0] . "</pre></p>";
        $info_result .= "<p><pre>" . $info_update[1] . "</pre></p>";

    }else{
        // workingcopy offline
        $wcopy = '../../book' ;		
    }

    // directorio de trabajo
    $directorio_recursos = $wcopy . '/' . $path_trabajo ;	
    
    
    // Creamos el archivo json con los datos
    $datos = $_POST["data"];
    $file = $directorio_recursos . "/data.json";
    file_put_contents($file, $datos);
    
    // Añadimos los archivos creados al repositorio y hacemos commit

    if ($online){

        $svn->add_all($directorio_recursos, $params_str);

        $info_commit = $svn->commit($directorio_recursos, $params_str . " -m syscommit");

        if (isset($info_commit[0]) ){
            $info_result .= "<p>Directorio para commitear: " . $directorio_recursos . "</p>";
            $info_result .= "<p>Commit: <pre>" . $info_commit[0]  . "</pre></p>";
            $info_result .= "<p><pre>" . $info_commit[1] . "</pre></p>";
            $info_result .= "<p><pre>" . $info_commit[2] . "</pre></p>";
            $info_result .= "<p><pre>" . $info_commit[3] . "</pre></p>";
        }
        else
            $info_result .= "<p>No hay cambios en el json existente.</p>";
    }else{
        $info_result = "<p>Working offline</p>";
    }

    echo $info_result;

?>