{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="container cont-checkdomain">
	<div class="row text-center container-form-domain">
		<div  class="form-group col-xs-12" >
			<p>&iexcl;{$nombre_check_domain}&#33;</p>
		</div>
		<form  id="form-domain" data-ruta="{$modules_dir}" >

		<div class=" col-xs-12 col-sm-12 col-md-3 col-lg-2"></div>
			<div class="form-group col-xs-9 col-sm-11 col-md-5 col-lg-7">					 
				<div class="input-group">	
							 
					<input class="form-control busca-roanja" type="text" placeholder="Escribe Tu Dominio" name="domain" />		
				  <div class="input-group-btn">
				  	<button class="btn-roanja btn btn-primary" type="submit">
				  		<span><i class="fa fa-search font-roanja"></i> Buscar</span> </button>
					<!--<input class="btn-roanja btn btn-primary" type="submit" value="Buscar" >-->
				</div>

				</div>

			</div>
			
		</form>
	</div>
	
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
					<th class="text-center">Agregar a Carrito</th>
				</tr>
			</thead>
			<tbody>
				<!--Body Dinamy-->
			</tbody>
		</table>
	</div>
	<div class="foot-checkdomain">		
			<span class="no-select-domains"> No has seleccionado ning&uacute;n dominio </span> 
			<span id="num-domains" class="select-domains hide" >0</span><span class="select-domains hide"> Dominios seleccionados </span>
			<button disabled class='btn btn-primary send-choose-domain'>Procesar <i class='fa fa-shopping-cart fa-2x '></i></button>
		</div>
</div>

</div>