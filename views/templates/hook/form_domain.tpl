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

{if isset($smarty.post.domain)}
{assign var="val" value=$smarty.post.domain}
{else}
{assign var="val" value=""}
{/if}
<div class="rj-background">
<div class="container cont-checkdomain">
	<div class="row text-center container-form-domain"> <!-- -->
		<div class="col-xs-12 col-lg-12">
				<div class="row">
					<div class="form-group col-xs-6 col-lg-6" style="margin: auto; float: none;">
						<p id="nombreBuscador" class="rj-title">{$nombre_check_domain}</p>
					</div>
				</div>
		<div class="form-group col-xs-9 col-sm-11 col-md-5 col-lg-6" style="margin: auto; float: none;">
			<form  id="form-domain" data-ruta="{$modules_dir}" action="{$link->getModuleLink('roanjacheckdomain','pagedomain')}" method="POST">
						<div class="input-group">

							<input id="domain" class="form-control busca-roanja" type="text" placeholder="Escribe tu dominio" name="domain" value="{$val}"/>
						  <div class="input-group-btn">
						  <button class="btn-roanja" type="submit">
						  		<span><i class="fa fa-search font-roanja"></i></span> </button>
						</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
