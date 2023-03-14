<?php 
Class Tools{
	//Función para convierte fecha
	public static function convierte_fecha($fecha){
		$dia_s=substr($fecha,8,3);
		$mes=substr($fecha,5,2);
		$anio=substr($fecha,0,4);

	
	switch ($mes){
		case '01': $mes="Enero"; break;
		case '02': $mes="Febrero"; break;
		case '03': $mes="Marzo"; break;
		case '04': $mes="Abril"; break;
		case '05': $mes="Mayo"; break;
		case '06': $mes="Junio"; break;	
		case '07': $mes="Julio"; break;	
		case '08': $mes="Agosto"; break;	
		case '09': $mes="Septiembre"; break;	
		case '10': $mes="Octubre"; break;	
		case '11': $mes="Noviembre"; break;	
		case '12': $mes="Diciembre"; break;
	}
		$correcta= $dia_s." de ".$mes." del ".$anio;
		return $correcta;
	}

    function obtener_edad_segun_fecha($fecha_nacimiento){
        $nacimiento = new DateTime($fecha_nacimiento);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }

    function limpiarCadena($valor){
        $valor = str_ireplace("SELECT","",$valor);
        $valor = str_ireplace("<script>","",$valor);
        $valor = str_ireplace("DATABASES","",$valor); 
        $valor = str_ireplace("TRUNCATE","",$valor);
        $valor = str_ireplace("DROP TABLE","",$valor); 
        $valor = str_ireplace("FROM","",$valor);
        $valor = str_ireplace("SHOW","",$valor);
        $valor = str_ireplace("WHERE","",$valor);
        $valor = str_ireplace(" * ","",$valor);
        $valor = str_ireplace("COPY","",$valor);
        $valor = str_ireplace("DELETE","",$valor);
        $valor = str_ireplace("DROP","",$valor);
        $valor = str_ireplace("DUMP","",$valor);
        $valor = str_ireplace(" OR ","",$valor);
        $valor = str_ireplace("%","",$valor);
        $valor = str_ireplace("LIKE","",$valor);
        $valor = str_ireplace("--","",$valor);
        $valor = str_ireplace("^","",$valor);
        $valor = str_ireplace("[","",$valor);
        $valor = str_ireplace("]","",$valor);
        $valor = str_ireplace("!","",$valor);
        $valor = str_ireplace("¡","",$valor);
        $valor = str_ireplace("?","",$valor);
        $valor = str_ireplace("=","",$valor);
        $valor = str_ireplace("&","",$valor);
        $valor = str_ireplace("==","",$valor);
        $valor = str_ireplace("()","",$valor);
        $valor = str_ireplace("'>","",$valor);
        $valor = str_ireplace("HTML","",$valor);
        $valor = str_ireplace("$(","",$valor);
        $valor = str_ireplace("').","",$valor);
        $valor = trim($valor);
        $valor = htmlspecialchars($valor);
        $valor = stripslashes($valor);

    return $valor;
    }
}

?>