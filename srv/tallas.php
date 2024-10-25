<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_TALLA.php";

ejecutaServicio(function () {

    // Obtenemos la lista de tallas de la base de datos
    $lista = select(pdo: Bd::pdo(), from: TALLA, orderBy: TALL_NOMBRE);

    $render = "<dl>";
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[TALL_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[TALL_NOMBRE]);
        $descripcion = htmlentities($modelo[TALL_DESCRIPCION]); // Aquí asumo que hay un campo TALL_DESCRIPCION

        // Construimos la estructura <dl> con <dt> y <dd> para cada campo
        $render .= "
        <dt>Nombre</dt>
        <dd><a href='modifica.html?id=$id'>$nombre</a></dd>

        <dt>Descripción</dt>
        <dd>$descripcion</dd>";
    }
    $render .= "</dl>";

    // Devolvemos el HTML generado en formato JSON
    devuelveJson(["lista" => ["innerHTML" => $render]]);
});
