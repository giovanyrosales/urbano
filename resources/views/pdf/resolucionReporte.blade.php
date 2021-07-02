<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte Resolución</title>
   
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

.fecha{   
    text-align: right;
    padding-right: 45px;
    font-size: 16px;
    font-family: "Times New Roman", Times, serif;
}

.solicitante{    
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

.notificacion{
  
    padding-left: 45px;
    padding-right: 20px;
  
}

@page {
      margin-top: 188px;
      margin-bottom: 151px;
    }



.atentamente{
    font-size: 16px;   
    padding-left: 45px;
    padding-right: 20px;
    font-family: "Times New Roman", Times, serif;   
}

.oficina{
    margin-top: 60px;
    font-size: 16px;   
    padding-right: 105px;    
    font-family: "Times New Roman", Times, serif;
    text-align: right;
}

</style>

    <!-- cabecera -->
    <div class="row"> 
      
            <p class="titulo">
            ALCALDIA MUNICIPAL DE METAPAN<br>
            CONTROL DEL DESARROLLO URBANO       
            </p>
    </div>

    <!-- fecha -->
    <div class="row">
        <div class="fecha">
            <p class="fecha">Metapán,  {{$diaSemana}} {{$dia}}  de  {{ $mes }}  de  {{ $anio }}</P>
        </div>
    </div>

    <!-- nombre y direccion -->
    <div class="row">      
        <p class="solicitante">Sr (a): {{$solicitante}}</P>    
        <p class="direccion">Dirección: {{$direccion}}</P>      
    </div>

    <!-- notificacion -->
    <div class="notificacion">
    <div align="justify">{!! $descripcion !!}</div>
        
        
    </div>

     <!-- atentamente -->
     <div class="row">
        <p class="atentamente">
            Atentamente.
        </p>
    </div>

    <!-- oficina -->
    <div class="row">
        <p class="oficina">
            Oficina de Control de Desarrollo Urbano
        </p>
    </div>

</body>
</html> 
