{include file="$ruta_modulo./views/templates/hook/form_domain.tpl"}
{addJsDefL name=year}{l s='year' js=1 mod='roanjacheckdomain'}{/addJsDefL}
{addJsDefL name=available}{l s='available' js=1 mod='roanjacheckdomain'}{/addJsDefL}
{addJsDefL name=taken}{l s='taken' js=1 mod='roanjacheckdomain'}{/addJsDefL}
{addJsDefL name=add}{l s='add' js=1 mod='roanjacheckdomain'}{/addJsDefL}
{addJsDefL name=added}{l s='added' js=1 mod='roanjacheckdomain'}{/addJsDefL}
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
							<th class="text-center">{l s='Domain' mod='roanjacheckdomain'}</th>
							<th class="text-center">{l s='Availability' mod='roanjacheckdomain'}</th>
					 <!-- <th class="text-center">Precio</th> -->
							<th class="text-center">{l s='Add to cart' mod='roanjacheckdomain'}</th>
						</tr>
					</thead>
					<tbody>
						<!--Body Dinamy-->
					</tbody>
				</table>
			</div>
				<div class="foot-checkdomain text-center">
					<!-- <h2 class="text-center" style="margin-top:3%; margin-bottom:3%;" >{l s='Selected Domains' mod='roanjacheckdomain'} </h2> -->


						<!-- <span id="num-domains" class="select-domains hide" >0</span><span class="select-domains hide"> {l s='Selected Domains' mod='roanjacheckdomain'} </span>
<div class="row text-center "> -->
	<h2>{l s='¿Que deseas hacer con tus Dominios?' mod='roanjacheckdomain'} </h2>
				<div id="append-dominio"> </div>


<div class="row">
  <div class="col-lg-4">
<a href="{$link->getPageLink("$order_process", true)|escape:"html":"UTF-8"}" class="btn btn-primary" >
	{l s='Proceed to checkout' mod='roanjacheckdomain'}
</a>
	</div>

  <div class="col-lg-4">
				<a href="/prestaroanja/?id_appagebuilder_profiles=23"  class="btn btn-primary">
					{l s='Ver planes de hosting' mod='roanjacheckdomain'}
				</a>
  </div>

<div class="col-lg-4">
		<a href="/prestaroanja/?id_appagebuilder_profiles=24" class="btn btn-primary" >
			{l s='Ver Paquetes especializados' mod='roanjacheckdomain'}
</a>
	</div>
</div>
</div>


				</div>
		</div>

</div>
