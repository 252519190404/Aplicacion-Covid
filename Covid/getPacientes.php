<?php
//SOLO ES PARA REALIZAR PRUEBAS
//Mostrar lista de contacto

$response = array();

$Cn = mysqli_connect("localhost","root","","covid-20")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $result = mysqli_query($Cn,"SELECT curp,nompac,corrpac,dompac,edad,lon,lati,tippac,estado,correodoc FROM paciente ORDER BY nompac");
    
    if (!empty($result)) {
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_array($result)){
                $paciente = array();
                $paciente["success"] = 200;  
                $paciente["message"] = "contactos encontrados";
                $paciente["curp"] = $res["curp"];
                $paciente["nompac"] = $res["nompac"];
                $paciente["corrpac"]=$res["corrpac"];
                $paciente["dompac"]=$res["dompac"];
                $paciente["edad"]=$res["edad"];
                $paciente["lon"]=$res["lon"];
                $paciente["lati"]=$res["lati"];
                $paciente["tippac"]=$res["tippac"];
                $paciente["estado"]=$res["estado"];
                $paciente["correodoc"]=$res["correodoc"];

                array_push($response, $paciente);
            }
           echo json_encode($response);
        } else {
            $paciente = array();
            $paciente["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
            $paciente["message"] = "contacto no encontrado";
            array_push($response, $paciente);
            echo json_encode($response);
        }
    } else {
        $paciente = array();
        $paciente["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
        $paciente["message"] = "contacto no encontrado";
        array_push($response, $paciente);
        echo json_encode($response);
    }
} else {
    $paciente = array();
    $paciente["success"] = 400;
    $paciente["message"] = "Faltan Datos entrada";
    array_push($response, $paciente);
    echo json_encode($response);
}
mysqli_close($Cn);
?>
