$(document).ready(function(){
getDomains();

$(document).on('submit', '#form-domain', function(e) {
	e.preventDefault();
    getDomains();

	});

//listen to ajax start event
$( document).ajaxStart(function() {
  });

//listen to ajax complete event
$( document).ajaxComplete(function() {
 
});

function getDomains(){

	var domain=$('#domain').val();
 var form,ruta,$container,newreg="";
    //var form=$(e.target);
    var ruta=$('#form-domain').data("ruta");
    $container=$('div.cont-checkdomain');
    $tbody=$container.find("#table-domains").find("tbody");
   var envdomain="domain="+domain;
    //var datarray = [['marvel.com',true,'$8.99','$16.99'],['dc.es',true,'$8.99','$16.99']];
  
$('#dimmer').fadeIn();

$.ajax({
  url:ruta+"roanjacheckdomain/ajax_checkdomain.php",
  data:envdomain+"&action=getDomains",
  type:"POST",
  dataType:"json",
  success:function(data){
            $('#dimmer').fadeOut();
           for(i=0;i<data.length;i++){
            $container.find('.domain-result').removeClass('hide');
            newreg+="<tr><td>" + data[i]["dominio"]+ "</td>"
var price="18.00€";
var price2="15.00€"
var year="al año";

            if(data[i]["estado"]=='disponible'){ 
                    newreg+="<td><i class='fa fa-check fa-2x'></i><span class='hidden-xs' style='color:green'> Disponible</span>&nbsp";
                    newreg+="<span class='price stroke'>" + price + "</span>&nbsp<span class='price'>" + price2 + "</span><span class='price-behind'>/" + year + "</span><br class='visible-xs'></td>";
                    newreg+="<td><button class='btn btn-primary choose-domain'>Agregar<i class='fa fa-shopping-cart fa-2x '></i></button></td></tr>";  
                }
                if(data[i]["estado"]=='no disponible'){
   newreg+="<td><i class='fa fa-times fa-2x'></i><span class='hidden-xs' style='color:red'> No disponible</span></td><td></td>";

                 }

        
                 if(data[i]["estado"]=='error')

        newreg+="<td><i class='fa fa-times fa-2x'> Error de Conexion</i></td>";

            } 
           
         $("#table-domains").find("tbody").html("").append(newreg);
        }
    }) 
  }

});	