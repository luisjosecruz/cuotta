<?php 

class Mandamientos
{

    public function __construct(){ }

    public function getInfoPay($data, $conn) {
        $stmt = $conn->prepare("
            SELECT 
                mandamientos.mandCorrelativo, 
                mandamientos.mandFechaFin,
                mandamientos.mandSaldoFinal,
                propiedades.propDireccion1,
                comunidades.comNombre,
                contactos.contNombre,
                contactos.contApellido,
                vinculacion.vincOrden
            FROM mandamientos 
                INNER JOIN propiedades ON propiedades.propID = mandamientos.propID
                INNER JOIN comunidades ON comunidades.comID = propiedades.comID
                INNER JOIN vinculacion ON propiedades.propID = vinculacion.vincPropID
                INNER JOIN contactos ON contactos.contID = vinculacion.vincContactoID
            WHERE vinculacion.vincOrden = 1 AND mandamientos.mandHash  = ?
        ");
        $stmt->bind_param("s", $data["route"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return json_encode($result);
    }
    
}

?>