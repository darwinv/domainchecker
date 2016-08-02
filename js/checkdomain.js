$(document).ready(function(){
getDomains();

$(document).on('submit', '#form-domain', function(e) {
	e.preventDefault();
    getDomains();

	});

function getDomains(){

	var dominio=$('#domain').val();
  var dominioclean=dominio.split(".");
  var domain=dominioclean[0];

 var form,ruta,$container,newreg="";

    var ruta=$('#form-domain').data("ruta");
    $container=$('div.cont-checkdomain');
    $tbody=$container.find("#table-domains").find("tbody");
   var envdomain="domain="+domain;
    //var datarray = [['marvel.com',true,'$8.99','$16.99'],['dc.es',true,'$8.99','$16.99']];


$('#dimmer').fadeIn(); //carga de imagen svg

$.ajax({
  url:ruta+"roanjacheckdomain/ajax_checkdomain.php",
  data:envdomain+"&action=getDomains",
  type:"POST",
  dataType:"json",
  success:function(data){
            $('#dimmer').fadeOut(); //desaparece imagen svg

						$('html,body').animate({
	    scrollTop:900
	}, 1000);

           for(i=0;i<data.length;i++){
            $container.find('.domain-result').removeClass('hide');
						var arrtld=data[i]["dominio"].split(".");
						var cleandominio=arrtld[0];
						var tld=arrtld[1];
            newreg+="<tr><td >" + data[i]["dominio"]+ "</td>";
            if(data[i]["estado"]=='disponible'){
                    newreg+="<td><i class='fa fa-check fa-2x'></i><span class='hidden-xs' style='color:green'>"+available+"</span>&nbsp";
                    newreg+="<span class='price'>" + data[i]['precio'] + data[i]['sign'] + "</span>&nbsp<span class='price-behind'>/"+year+"</span><br class='visible-xs'></td>";
     //newreg+="<td><button id='select-domain-"+data[i]['id_producto']+"' class='btn btn-primary choose-domain' data-nombre="+data[i]['dominio']+" data-dominio="+data[i]['id_producto']+">Agregar<i class='fa fa-shopping-cart fa-2x '></i></button></td></tr>";
								var url_cart=decodeURIComponent(data[i]['url_cart']);//.replace("%3D","=");
					newreg+="<td><a class='nomb_"+cleandominio+'-'+tld+" button ajax_add_to_cart_button choose-domain btn btn-default' rel='nofollow' data-id-product="+data[i]['id_producto']+" href="+data[i]['url_cart']+" data-tld="+tld+" data-nombre="+data[i]['dominio']+" data-dominio="+data[i]['id_producto']+"> <i class='fa fa-shopping-cart fa-2x '></i>"+ add +"  </a></td></tr>";
			          }
                if(data[i]["estado"]=='no disponible'){
   newreg+="<td><i class='fa fa-times fa-2x'></i><span class='hidden-xs' style='color:red'>"+taken+"</span></td><td></td>";
                 }

                 if(data[i]["estado"]=='error')
     newreg+="<td><i class='fa fa-times fa-2x'> Error de Conexion</i></td>";
            }

         $("#table-domains").find("tbody").html("").append(newreg);
        }
    })
  }





$(document).on('click', '.choose-domain', function(e) {
    var ruta=$('#form-domain').data("ruta");
   var id_producto = $(this).data('dominio');
   var nombre=$(this).data('nombre').split(".");
	 var tld=$(this).data('tld');
	var nombrecomp=nombre[0]+"-"+tld;
  var envproducto="producto="+id_producto;

  $(this).html(" <i class='fa fa-check-square-o fa-2x '></i>"+added);

$(this).addClass("disabled");
  $.ajax({
          url:ruta+"roanjacheckdomain/ajax_checkdomain.php",
          data:envproducto+"&action=setCartDomain",
          type:"POST",
          dataType:"json",
         success:function(data){
         if(data.result){

   $('#append-dominio').append('<span class="cartdomains" title="eliminar"  data-id='+id_producto+' > <span data-nombre='+nombrecomp+'> <i class="fa fa-times-circle" aria-hidden="true"></i> </span>'+nombre+'</span>');
         }
            }
        })

  });

$(document).on('click','.cartdomains > span',function(e){
	var nombredominio=$(this).data('nombre');
$('.nomb_'+nombredominio).removeClass('disabled');
console.log($('.nomb_'+nombredominio));
$('.nomb_'+nombredominio).html("<i class='fa fa-shopping-cart fa-2x '></i>"+add);
//var val=$(this).parent('span');
$(this).parent('span').remove();


});


});
