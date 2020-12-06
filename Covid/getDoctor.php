<?php
/*
 * El siguiente código localiza un usuario
 * Pablo Reynoso    Noviembre/2020
 */

$response = array();
$doctor = array();
$Cn = mysqli_connect("localhost","root","","covid-20")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

// Checa que le este llegando por el método POST el correodoc

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $objArray = json_decode(file_get_contents("php://input"),true);
    
    $correodoc=$objArray['correodoc'];
    $pasw=$objArray['pasw'];
    
    
$result = mysqli_query($Cn,"SELECT correodoc,nomdoc,pasw,fechareg from doctor WHERE correodoc = '$correodoc' AND pasw = '$pasw'");

    if (!empty($result)) {
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);
            $doctor["success"] = 200;   // El success=200 es que encontro el usuario
            $doctor["message"] = "usuario encontrado";
            $doctor["correodoc"] = $result["correodoc"];
            $doctor["nomdoc"] = $result["nomdoc"];
            $doctor["pasw"] = $result["pasw"];
            $doctor["fechareg"] = $result["fechareg"];
            
            array_push($response,$doctor);
            

           // codifica la información en formato de JSON response
           echo json_encode($response);
        } else {
            // No Encontro el usuario
            $doctor["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
            $doctor["message"] = "usuario no encontrado";
            array_push($response,$doctor);
            echo json_encode($response);
        }
    } else {
        $doctor["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
        $doctor["message"] = "usuario no encontrado";
        array_push($response,$doctor);
        echo json_encode($response);
    }
} else {
    // required field is missing
    $doctor["success"] = 400;
    $doctor["message"] = "Faltan Datos entrada";
    array_push($response,$doctor);
    echo json_encode($response);
}
mysqli_close($Cn);
?>