<?php
/*
 * El siguiente código localiza un usuario
 * Pablo Reynoso    Noviembre/2020
 */

$response = array();
$paciente = array();
$Cn = mysqli_connect("localhost","root","","covid-20")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

// Checa que le este llegando por el método POST el correodoc

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $objArray = json_decode(file_get_contents("php://input"),true);
    
    $nompac=$objArray['nompac'];
    
    
$result = mysqli_query($Cn,"SELECT curp,nompac,corrpac,dompac,edad,lon,lati,tippac,estado,correodoc from paciente WHERE nompac = '$nompac'");

    if (!empty($result)) {
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);
            $paciente["success"] = 200;   // El success=200 es que encontro el usuario
            $paciente["message"] = "usuario encontrado";
            $paciente["curp"] = $result["curp"];
            $paciente["nompac"] = $result["nompac"];
            $paciente["corrpac"] = $result["corrpac"];
            $paciente["dompac"] = $result["dompac"];
            $paciente["edad"] = $result["edad"];
            $paciente["lon"] = $result["lon"];
            $paciente["lati"] = $result["lati"];
            $paciente["tippac"] = $result["tippac"];
            $paciente["estado"] = $result["estado"];
            $paciente["correodoc"] = $result["correodoc"];

            
            array_push($response,$paciente);
            

           // codifica la información en formato de JSON response
           echo json_encode($response);
        } else {
            // No Encontro el usuario
            $paciente["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
            $paciente["message"] = "usuario no encontrado";
            array_push($response,$paciente);
            echo json_encode($response);
        }
    } else {
        $paciente["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
        $paciente["message"] = "usuario no encontrado";
        array_push($response,$paciente);
        echo json_encode($response);
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