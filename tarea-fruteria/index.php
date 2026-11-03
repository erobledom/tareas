<?php
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad


// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = [];
}

// No hay definido un cliente todavía en la session 
if (!isset($_SESSION['cliente'])) {
    include 'bienvenida.php';
    die();
    
}


// Proceso las acciones 
if (isset($_POST["accion"])) {

switch ($_POST["accion"]) {
     case " Anotar ":
        $fruta = $_POST["fruta"];
        $cantidad = $_POST["cantidad"];
        // Actualizo la tabla de pedido
        $_SESSION['pedidos'][$fruta] = $cantidad;
        break;
    case " Anular ":
        $fruta = $_POST["fruta"];
        // Elimino la fruta de la tabla de pedidos en la sesión
        unset($_SESSION['pedidos'][$fruta]);
        break;
    case " Terminar ":
           // Destruyo la sesión y vuelvo a la página de bienvenida
           $compraRealizada = htmlTablaPedidos();
           $_SESSION = [];
           session_destroy();
           require_once 'compra.php';
           die();
        break;
            

}

$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    $msg = "";
    $msg .= "<table border='1'>";
    foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
        $msg .= "<tr><td>$fruta</td><td>$cantidad</td></tr>";
    }
    $msg .= "</table>";
    return $msg;
}
}