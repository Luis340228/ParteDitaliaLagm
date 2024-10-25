<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaID(false|string $id)
{

 if ($id === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el ID.",
   type: "/error/faltaid.html",
   detail: "La solicitud no tiene el valor de ID."
  );

 $trimID = trim($id);

 if ($trimID === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "ID en blanco.",
   type: "/error/idenblanco.html",
   detail: "Pon texto en el campo ID.",
  );

 return $trimID;
}