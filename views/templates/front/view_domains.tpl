{include file="$ruta_modulo./views/templates/hook/form_domain.tpl"}
<div id="dimmer"></div>
<div id="domaindec" class="cont-checkdomain" data-domain="{$smarty.post.domain}">
		<div class="domain-result hide">
			<br>
			<br>
			<hr>


			<div class="row text-center" style="margin: 30px">
				<table id="table-domains" class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">Dominio</th>
							<th class="text-center">Disponibilidad</th>
					 <!-- <th class="text-center">Precio</th> -->
							<th class="text-center">Agregar a Carrito</th>
						</tr>
					</thead>
					<tbody>
						<!--Body Dinamy-->
					</tbody>
				</table>
			</div>
				<div class="foot-checkdomain text-center">
					<h2 class="text-center" style="margin-top:3%; margin-bottom:3%;" >Dominios Seleccionados </h2>
						<div id="append-dominio"> </div>

						<span id="num-domains" class="select-domains hide" >0</span><span class="select-domains hide"> Dominios seleccionados </span>
					<div>
						<button disabled class='btn btn-primary send-choose-domain'>Procesar <i class='fa fa-shopping-cart fa-2x'></i></button>
					</div>
				</div>
		</div>

</div>
