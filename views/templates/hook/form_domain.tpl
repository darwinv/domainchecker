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
<div class="container">
	<div class="row text-center container-form-domain">
		<div  class="form-group col-xs-12" >
			<p>&iexcl;{$nombre_check_domain}&#33;</p>
		</div>
		<form  id="form-domain" data-ruta="{$modules_dir}" >
		<div class=" col-xs-12 col-sm-12 col-md-3 col-lg-2"></div>
			<div class="form-group col-xs-9 col-sm-11 col-md-5 col-lg-7">					 
				<div class="input-group">	
							 
					<input class="form-control" type="text" placeholder="Escribe Tu Dominio" name="domain" />	

					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Top 10 [.es, .com...] <span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-title-domain" >Todos</li>
							   <li ><a href="#" data-toggle="tooltip" data-placement="left" title="Aca ira informacion sobre los dominios, desde .com, .ve, .arg, .es hasta .eu" >Top 10 [.es, .com...]</a></li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca ira infor.arg, .es hasta .eu"><a href="#">Nuevos</a></li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca hasta .eu"><a href="#">Clasicos</a></li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca ira informacion sobre los dominios, desde .com, .ve, .arg, .es hasta .eu"><a href="#">Todos</a></li>
							<li class="dropdown-title-domain" >Otros</li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca ira informacion sobre los dominios, desde .com, .ve, .arg, .es hasta .eu" ><a href="#">Compras</a></li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca ira informacion sobre los dominios, desde .com, .ve, .arg, .es hasta .eu"><a href="#">Educaci&oacute;n/Polit&iacute;</a></li>
							   <li data-toggle="tooltip" data-placement="left" title="Aca ira informacion sobre los dominios, desde .com, .ve, .arg, .es hasta .eu"><a href="#">Salud/Alimentaci&oacute;n</a></li>									
						</ul>
					</div>				
				</div>
			</div>
			<div class="col-xs-3 col-sm-1 col-md-1 col-lg-1">
				<div class="pull-left">
					<input class="btn btn-primary" type="submit" value="Buscar" >
				</div>
			</div>
		</form>
	</div>
	<br>
	<br>
	<hr>
	<br>
	<br>
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
</div>