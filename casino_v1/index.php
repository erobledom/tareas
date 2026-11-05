<?php
session_start();

$msg="";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {

    if (isset($_POST['cantidadini'])) {
        $_SESSION['disponible'] = (int)$_POST['cantidadini'];
    } else {
        // Cambiar  visitar --> VALOR DE COOKIE
        // Solo cuento la visita una vez por sesión nueva
        if (! isset($_SESSION['visitas'])) {
            $_SESSION['visitas'] = ($_COOKIE['visitas'] ?? 0) + 1;
            // Actualizo el cookie de visitas

            // Un mes
            setcookie('visitas', $_SESSION['visitas'], time() + 60 * 60 * 24 * 30);
        }
        $visitas = $_SESSION['visitas'];

        require_once "form_bienvenida.php";
        // No continuo despues de mostrar los formularios
        exit();
    }
}

// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
    $cantidad = (int)$_POST['cantidad'];
    if ($cantidad < 1) {
        $msg = "Error: introduzca una cantidad mayor que 0.";
    } elseif ($cantidad > $_SESSION['disponible']) {
        $msg = "Error: no dispone de $cantidad euros disponibles.";
    } else {
        $msg = procesarApuesta($cantidad, $_SESSION['disponible'], $_POST['apuesta']);
    }
}

// Cambiar disponible --> VALOR DE SESSION
$disponible = $_SESSION['disponible'];

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] <= 0) ) {
    require_once "despedida.php";
    session_destroy();
    exit();
}

// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
    $numero = rand(1, 36);
    $resultado = ($numero % 2 == 0) ? "PAR" : "IMPAR";
    $msgresultado = "RESULTADO DE LA APUESTA : $resultado <br>";

    if ($resultado == $apuesta) {
        $saldodisponible += $valorapuesta;
        $msgresultado .= "GANASTE";
    } else {
        $saldodisponible -= $valorapuesta;
        $msgresultado .= "PERDISTE";
    }
    return $msgresultado;
}