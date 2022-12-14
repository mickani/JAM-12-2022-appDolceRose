<?php
function cfecha($fecha){    
    $length = strrpos($fecha," ");
    $newDate = explode( "-" , substr($fecha,$length));
    //$lafecha = $newDate[2]."/".$newDate[1]."/".$newDate[0];
    $lafecha=substr($fecha,8,2)."-".substr($fecha,5,2)."-".substr($fecha,0,4);
    return $lafecha;
}
?>