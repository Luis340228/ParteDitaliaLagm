<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaID.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaDescripcion.php";
require_once __DIR__ . "/../lib/php/validaEstado.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";

ejecutaServicio(function () {

 $id = recuperaTexto("id");
 $nombre = recuperaTexto("nombre");
 $descripcion = recuperaTexto("desc");
 $estado = recuperaTexto("estado");

 $id = validaID($id);
 $nombre = validaNombre($nombre);
 $descripcion = validaDescripcion($descripcion);
 $estado = validaEstado($estado);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: PASATIEMPO, values: [PAS_NOMBRE => $nombre]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/pasatiempo.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
 ]);
});
