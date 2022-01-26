<?php 

function getData($pdo, $route)
{
    $sql = "SELECT reciboID, reciboNumero, reciboSerie, DATE_FORMAT(recibos.reciboFecha, '%d/%m/%Y') reciboFecha, 
            reciboMonto, reciboLink, contactos.contNombre, contactos.contApellido, 
            propiedades.propAlias, propiedades.propTipo, propiedades.propDireccion1, 
            abonos.abonoData, DATE_FORMAT(abonos.abonoTStamp, '%d/%m/%Y') abonoTStamp
            FROM recibos 
            INNER JOIN propiedades ON propiedades.propID = recibos.propID
            INNER JOIN vinculacion ON vinculacion.vincPropID = propiedades.propID
            INNER JOIN contactos ON contactos.contID = vinculacion.vincContactoID
            INNER JOIN transacciones ON recibos.transID = transacciones.transID
            INNER JOIN abonos ON transacciones.abonoID = abonos.abonoID
            WHERE reciboLink = ?
            AND vinculacion.vincOrden = 1";
    $query = $pdo->prepare($sql);
    $query->execute([$route]);

    return $query;
}

function getLogo($pdo, $route)
{
    $sql = "SELECT comunidades.comLogo, comunidades.comNombre FROM recibos 
            INNER JOIN propiedades ON propiedades.propID = recibos.propID
            INNER JOIN comunidades ON propiedades.comID = comunidades.comID
            WHERE reciboLink = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$route]);

    return $query;
}

?>