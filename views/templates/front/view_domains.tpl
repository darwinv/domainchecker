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
					<h2 class="text-center" style="margin-top:3%; margin-bottom:3%;" >{l s='Selected Domains' mod='roanjacheckdomain'} </h2>
						<div id="append-dominio"> </div>

						<span id="num-domains" class="select-domains hide" >0</span><span class="select-domains hide"> {l s='Selected Domains' mod='roanjacheckdomain'} </span>
					<div>
						<button disabled class='btn btn-primary send-choose-domain'>{l s='Process' mod='roanjacheckdomain'}<i class='fa fa-shopping-cart fa-2x'></i></button>
					</div>
				</div>
		</div>

</div>
