<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte Expediente</title>
   
</head>
<body>

<style>

.titulo{
    text-align: center;
    font-size: 25px;
    font-weight: bold;
    padding-right: 15px;
    font-family: "Times New Roman", Times, serif;   
}

.subtitulo{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    padding-right: 15px;
    font-family: "Times New Roman", Times, serif;   
}

.solicitante{    
    margin-top: 40px;
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;  
    text-align: justify; 
}

.direccion{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.telefono{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.fecha{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.proceso{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.estado{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.correo{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.comentario{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: justify;  
}

.notificacion{
  
    padding-left: 45px;
    padding-right: 20px;
  
}

@page {
      margin-top: 50px;
      margin-bottom: 50px;
    }

.logotitulo{
    float:left;
    padding-left: 25px; 
    padding-top: 10px;
    margin-left: 15px;  
    width: 70px;
    height: 90px;
}


.oficina{
    margin-top: 60px;
    font-size: 16px;   
   
    font-family: "Times New Roman", Times, serif;
    text-align: center;
    margin-top: 200px;
}

</style>

    <!-- cabecera -->
    <div class="row"> 
    <img src="{{ asset('/images/logocolor.jpg') }}" alt="Admin Logo"class="logotitulo"/>
            <p class="titulo">
            ALCALDIA MUNICIPAL DE METAPAN<br>
            CONTROL DEL DESARROLLO URBANO       
            </p>
            
            <p class="subtitulo">
            Expediente #{{ $exp }}    
            </p>
    </div>


        <!-- nombre y direccion -->
        <div class="row">      
            <p class="solicitante">Solicitante: {{ $solicitante }}</P>    
            <p class="direccion">Dirección: {{ $direccion }}</P>   
            <p class="telefono">Teléfono: {{ $telefono }}</P>
            <p class="fecha">Fecha: {{ $fecha }}</P>  
            <p class="proceso">Proceso: {{ $nombreProceso }}</P> 
            <p class="estado">Estado: {{ $nombreEstado }}</P>
            <p class="correo">Correo: {{ $correo }}</P>
            <p class="comentario">Comentario: {{ $comentarios }}</P>
        </div>        
    </div>

    <!-- oficina -->
    <div class="row">
     
        <p class="oficina">Desarrollo urbano <br>         
                Alcaldía Municipal de Metapán</p>

    </div>

</body>
</html> 
