<?php
include('soda/public/socrata.php');
error_reporting(-1);

$app_token="BLB5qps4GxBmzdIHdSqujyOSm";
$socrata = new Socrata("datos.gov.co",$app_token);

if($_GET["id"]=="muertes"){
$response = $socrata->get("npnf-f7xg");
}else{
  $response = $socrata->get("s5e2-rk95");
}




for($i=0;$i<count($response);$i++):

		$data[$i]=$response[$i]["departamento"];
endfor;

$valores = array_count_values($data);


foreach ($valores as $key => $value) {

	
	$goo=str_replace(" ","+", $key);

	$data =json_decode( file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$goo.",+colombia&key=AIzaSyAIc0bHsiqMsR6vclDJ3GNmGrdb3rGHtsg"), true );
	$matriz[]=[
		"nombre"=>$key,
		"dato"=>$value,
		"posi"=>$data["results"][0]["geometry"]["location"]
		
	];
	
}
	$matrizJS=json_encode($matriz);
?>


<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        width: 100%;
        height: 800px;
        background-color: grey;
      }
    </style>
  </head>
  <body>
   
    <div id="map"></div>
  </body>
</html>
    <script>

          function initMap() {
  	
        var colombia = {lat: 5.2444204, lng:-75.1376733 };
  var map = new google.maps.Map(document.getElementById('map'), {
    center: colombia,
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });


var matriz = <?php echo $matrizJS; ?>;
var medidor = "<?php echo $_GET["id"]; ?>";

console.log(medidor);
if(medidor=="muertes"){
for (var i = 0; i < matriz.length; i++) {


var myLatLng = new google.maps.LatLng(matriz[i]["posi"]["lat"], matriz[i]["posi"]["lng"]);

    console.log(matriz[i]["dato"]);
     var contentString = "<h1>"+matriz[i]["nombre"]+"</h1> <h3>Delito Homicidios</h3> Cantidad: "+matriz[i]["dato"]+"";

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
position: myLatLng,
map: map,
title: matriz[i]["nombre"],
});

google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
    return function() {
      infowindow.close();
        infowindow.setContent(content);
        infowindow.open(map,marker);
    };
})(marker,content,infowindow));
}

}else{
for (var i = 0; i < matriz.length; i++) {


var myLatLng = new google.maps.LatLng(matriz[i]["posi"]["lat"], matriz[i]["posi"]["lng"]);

		console.log(matriz[i]["dato"]);
     var contentString = "<h1>"+matriz[i]["nombre"]+"</h1> <h3>Delito Hurto Celulares</h3> Cantidad: "+matriz[i]["dato"]+"";

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
position: myLatLng,
map: map,
title: matriz[i]["nombre"],
});

google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
    return function() {
    	infowindow.close();
        infowindow.setContent(content);
        infowindow.open(map,marker);
    };
})(marker,content,infowindow));
}

}
setTimeout(function () { infowindow.close(); }, 5000);




  
	 }
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxOln1mXJuLA0uykwiTOassXus5W_AWGc&callback=initMap"
  type="text/javascript"></script>

