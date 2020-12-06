<?php
//AddUsuario SOLO ES UTILIZADO PARA PRUEBAS PARA AGREGAR USUARIO
//Agregar un Usuario

$response = array();
$paciente = array();

$Cn = mysqli_connect("localhost","root","","covid-20")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

// Checa que le este llegando por el método POST el nomProd,existencia y precio

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $objArray = json_decode(file_get_contents("php://input"),true);
    if (empty($objArray))
    {
        // required field is missing
        $paciente["success"] = 400;
        $paciente["message"] = "Faltan Datos entrada";
        array_push($response,$paciente);
        echo json_encode($response);
    }
    else{
        $curp=$objArray['curp']; 
        $nompac=$objArray['nompac'];
        $corrpac=$objArray['corrpac'];
        $dompac=$objArray['dompac'];
        $edad=$objArray['edad'];
        $lon=$objArray['lon'];
        $lati=$objArray['lati'];
        $tippac=$objArray['tippac'];
        $estado=$objArray['estado'];
        $correodoc=$objArray['correodoc'];


        $result = mysqli_query($Cn,"INSERT INTO paciente(curp,nompac,corrpac,dompac,edad,lon,lati,tippac,estado,correodoc) values 
        ('$curp','$nompac','$corrpac','$dompac','$edad','$lon','$lati','$tippac','$estado','$correodoc')");
        //$idprod = mysqli_insert_id($Cn);
        if ($result) {   
            $paciente["success"] = 200;   // El success=200 es que encontro eñ contacto
            $paciente["message"] = "contacto Insertado";

            array_push($response,$paciente);
            echo json_encode($response);
        } else {
                // 
                $paciente["success"] = 406;  
                $paciente["message"] = "contacto no Insertado";
                array_push($response,$paciente);
                echo json_encode($response);
        }
    }
} else {
    // required field is missing
    $paciente["success"] = 400;
    $paciente["message"] = "Faltan Datos entrada";
    array_push($response,$paciente);
    echo json_encode($response);
}
mysqli_close($Cn);
?>
