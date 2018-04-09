<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<input type="submit" name="data" value="Delito Homicidios" id="boton1" onClick = "accion('muertes');">

<input type="submit" name="data" value="Delito Hurto Celulares" id="boton1" onClick = "accion('celular');">

<div id="data">
	
</div>
<script>
    function accion(info)
    {
        $.ajax({
            type:'get',
            url: 'celular.php',
            data: {id:info},
            success:function(data){
                $("#data").html(data);
                console.log("bien");
           },
           error:function(data){
            console.log("mal");
           }
         });
    }
</script>