<!--
Alexander Guarin 
Karen Rodriguez
-->



<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<style type="text/css">
	#data{
		width: 100%;
		height: 100%;
		text-align: center;
	}
	#data img{
		margin: 0 auto;
	}

</style>
<body class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-4">
			<input type="submit" name="data" value="Delito Homicidios" id="boton1" onClick = "accion('muertes');">
		</div>
		<div class="col-md-4">
			<input type="submit" name="data" value="Delito Hurto Celulares" id="boton1" onClick = "accion('celular');">
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
	<div class="row">
		<div id="data" class="col-md-12"></div>
	</div>
</body>





<script>
    function accion(info)
    {

    	$("#data").html('<img src="cargar.gif">');

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

<img src="">