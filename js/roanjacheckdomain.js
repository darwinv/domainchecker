$(document).ready(function(){
  //$('[data-toggle="tooltip"]').tooltip();
  
	$(document).on('submit', '#form-domain', function(e) {
    e.preventDefault();
    var form=$(e.target);
    var ruta=$(this).data("ruta");
    $.ajax({
        url:ruta + "roanjacheckdomain/ajax_checkdomain.php",
        data:form.serialize() + "&action=getDomains",
        type:"POST",
        dataType:"json",
        success:function(data){
        var newreg="";

            newreg+="<tr><td>" + data.dominio+ "</td>";
            if(data.disponible){
              newreg+="<td><i class='fa fa-check fa-2x'> Disponible</i></td>";
            }else{
              newreg+="<td><i class='fa fa-times fa-2x'> Tomado</i></td>";
            }
            newreg+="<td><i class='fa fa-cart-plus fa-2x'></i></td></tr>";
         
         $("#table-domains").find("tbody").html("").append(newreg);
      }
    });
  });
});