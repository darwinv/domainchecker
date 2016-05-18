$(document).ready(function(){


/*
var domain=$('#domaindec').data('domain');
 var form,ruta,$container,newreg="";
    //var form=$(e.target);
    var ruta=$('#form-domain').data("ruta");
    $container=$('div.cont-checkdomain');
    $tbody=$container.find("#table-domains").find("tbody");
   $tbody.addClass('opac05');
   var envdomain="domain="+domain;
$.ajax({
  url:ruta+"roanjacheckdomain/ajax_checkdomain.php",
  data:envdomain+"&action=getDomains",
  type:"POST",
  dataType:"json",
  success:function(data){
  $container.find('.domain-result').removeClass('hide');
           for(i=0;i<data.length;i++){
            //    alert(data[i]["title"])
            newreg+="<tr><td>" + data[i]["dominio"]+ "</td>"


            if(data[i]["estado"]=='disponible'){ 
                    newreg+="<td><i class='fa fa-check fa-2x'><span class='hidden-xs'> Disponible</span></i></td>";
                    newreg+="<td><button class='btn btn-primary choose-domain'>Elegir <i class='fa fa-shopping-cart fa-2x '></i></button></td></tr>";  
                }
                if(data[i]["estado"]=='no disponible')

         newreg+="<td><i class='fa fa-times fa-2x'><span class='hidden-xs'> No disponible</span></i></td>";

                 if(data[i]["estado"]=='error')

        newreg+="<td><i class='fa fa-times fa-2x'> Error de Conexion</i></td>";

            } 
           
         $("#table-domains").find("tbody").html("").append(newreg);
  }
})*/

  //$('[data-toggle="tooltip"]').tooltip();
  
	/*$(document).on('submit', '#form-domain', function(e) {
    e.preventDefault();
    
   var form,ruta,$container,newreg="";
    var form=$(e.target);
    var ruta=$(this).data("ruta");
    $container=$('div.cont-checkdomain');
    $tbody=$container.find("#table-domains").find("tbody");
   $tbody.addClass('opac05');

    $.ajax({
        url:ruta + "roanjacheckdomain/ajax_checkdomain.php",
        data:form.serialize() + "&action=getDomains",
        type:"POST",
        dataType:"json",
        success:function(data){
$container.find('.domain-result').removeClass('hide');
           for(i=0;i<data.length;i++){
            //    alert(data[i]["title"])
            newreg+="<tr><td>" + data[i]["dominio"]+ "</td>"


            if(data[i]["estado"]=='disponible'){ 
                    newreg+="<td><i class='fa fa-check fa-2x'><span class='hidden-xs'> Disponible</span></i></td>";
                    newreg+="<td><button class='btn btn-primary choose-domain'>Elegir <i class='fa fa-shopping-cart fa-2x '></i></button></td></tr>";  
                }
                if(data[i]["estado"]=='no disponible')

         newreg+="<td><i class='fa fa-times fa-2x'><span class='hidden-xs'> No disponible</span></i></td>";

                 if(data[i]["estado"]=='error')

        newreg+="<td><i class='fa fa-times fa-2x'> Error de Conexion</i></td>";

            } 
           
         $("#table-domains").find("tbody").html("").append(newreg);
      }
    });
  }); */








$(document).on('click', '.choose-domain', function(e) {
    var count,$container,state;
    $container=$('div.cont-checkdomain');
    count= parseInt($container.find("#num-domains").html());
    state = $(this).data('state');
 

    switch(state){
        case 1 :
        case undefined : 
            count++;
            $container.find("#num-domains").html(count);
            $(this).html("Agregado <i class='fa fa-check-square-o fa-2x '></i>");
            $(this).data('state', 2);
            break;
        case 2 :
            count--;
            $container.find("#num-domains").html(count);
            $(this).html("Agregar <i class='fa fa-shopping-cart fa-2x '></i>");
            $(this).data('state', 1); 
            break;
    }

    if(count>=1){
      $container.find('span.select-domains').removeClass('hide');
      $container.find('span.no-select-domains').addClass('hide');
      $container.find('button.send-choose-domain').prop("disabled", false);      
    }else{
      $container.find('span.no-select-domains').removeClass('hide');
      $container.find('span.select-domains').addClass('hide');
      $container.find('button.send-choose-domain').prop("disabled", true);
    }

  });



});