<?php
//Se editara un usuario
//En el Query se usa de referencia el Celular

$response = array();
$paciente = array();

$Cn = mysqli_connect("localhost","root","","covid-20")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

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
       
        
        


        $result = mysqli_query($Cn,"UPDATE paciente SET curp='$curp'nompac=$nompac,corrpac=$corrpac,dompac=$dompac,edad=$edad,lon=$lon,lati=$lati,tippac=$tippac,estado=$estado,correodoc=$correodoc WHERE curp='$curp'");
        if ($result) {   
            $paciente["success"] = 200;   // El success=200 es que encontro eñ producto
            $paciente["message"] = "Producto Actualizado";
            array_push($response,$paciente);
            echo json_encode($response);
        } else {
                $paciente["success"] = 406;  
                $paciente["message"] = "El Producto no se actualizo";
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
