<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte Bitacora</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

<style>

.titulo{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    padding-right: 85px;
    margin-top: 11px;
    font-family: "Times New Roman", Times, serif;   
}

.num{
    text-align: center;
    font-size: 20px;
    font-weight: normal;
    margin-top: 11px;
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



@page { margin: 2cm;  }
    .firstpage { 
      position: absolute;
      page-break-after: always; 
      top: -50px; // compensating for @page top margin
      width: 100%;
      margin: 0;
    }
  
    .otherpages{ margin: 4cm; }


    

.logotitulo{
    float:left;
    padding-left: 25px; 
    margin-left: 15px;  
    width: 65px;
    height: 85px;
}


.oficina{
    font-size: 16px;   
    font-family: "Times New Roman", Times, serif;
    text-align: center;
    padding-right: 30px;
    padding-top: 150px;
}

.ofi{
    margin-top: 2px;
    padding-top: 150px;
}

.mitabla{
    padding-top: 20px;
    float: left;
}

.fila1{
    margin-top: 25px;
}

.s1{
    font-size: 16px;   
    font-family: "Times New Roman", Times, serif;
    text-align: left;  
}

.s2{
    font-size: 16px;   
    font-family: "Times New Roman", Times, serif;
    text-align: left;   
}



</style>

    <!-- cabecera -->
    <div class="row"> 
    <img src="{{ asset('/images/logocolor.jpg') }}" alt="Admin Logo"class="logotitulo"/>
            <center><p class="titulo">
            ALCALDIA MUNICIPAL DE METAPAN<br>
            CONTROL DEL DESARROLLO URBANO       
            </p></center>
           
    </div>

    <div>      
            <p class="num">Bitacora</P> 
        </div>  

         <!-- nombre y direccion -->
         <div class="fila1">      
            <p class="s1"><strong>Expediente #</strong>{{ $expediente }}</P>  
            <p class="s1"><strong>Solicitante:</strong> {{ $solicitante }}</P>        
            <p class="s2"><strong>Comentario:</strong> {{ $comentario }}</P>
        </div>   

    <div class="mitabla">
        <table style="width:100%" >       
            <tr>
            <td> 
            @foreach($bitacora as $dato)
           
                <img style="margin-bottom: 15px; padding:25px" src="{{ url('storage/bitacora/'.$dato->url) }}"  width="260px" height="225px">

                @if($loop->iteration % 2 == 0)
                </td>
            </tr>

            <tr>
                
             <td>
                @endif
           
            
            @endforeach 
            </tr>
           
            </table>

    </div>
		

         <!-- oficina -->
    <div class="ofi">
     
     <p class="oficina">Desarrollo urbano <br>         
             Alcaldía Municipal de Metapán</p>

    </div>
   


</body>
</html> 









