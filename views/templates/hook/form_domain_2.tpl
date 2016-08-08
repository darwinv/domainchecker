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
<!-- <div class="rj-background"> -->
<div style="padding: 4% 0% 0% 5%;" class="cont-checkdomain">
	<div class="row container-form-domain" style="border-bottom: 2px solid rgb(204, 204, 204); padding-bottom: 10px; margin-right: 22px;"> <!-- -->
		<div class="form-group col-xs-9 col-sm-11 col-md-8 col-lg-8" style="margin: auto;">
			<h3 style="text-transform: none;">{l s='Cámbiate a ROANJA - ¡Es así de fácil!' mod='roanjacheckdomain'}</h3>                            
			<p style="font-size: inherit; color: rgb(102, 102, 102); margin-bottom: 3%; font-family: inherit;">
			<i class="fa fa-check">&nbsp;&nbsp;&nbsp;</i>{l s='Cambio seguro y facil sin esfuerzo' mod='roanjacheckdomain'}</p>                            
			<p style="margin-bottom: 5%; font-size: inherit; color: rgb(102, 102, 102); font-family: inherit;">
			<i class="fa fa-check">&nbsp;&nbsp;&nbsp;</i>{l s='Soporte profesional por teléfono, e-mail e internet' mod='roanjacheckdomain'}</p>

			<form  id="form-domain" data-ruta="{$modules_dir}" action="{$link->getModuleLink('roanjacheckdomain','pagedomain')}" method="POST">
						<div class="input-group">

							<input id="domain" class="form-control busca-roanja" type="text" placeholder="{l s='Write here your domain' mod='roanjacheckdomain'}" name="domain" value="{$val}"/>
						  <div class="input-group-btn">
						  <button class="btn-roanja" type="submit">
						  		<span><i class="fa fa-search font-roanja"></i></span> </button>
						</div>
						</div>
				</form>
			</div>
			<div class="col-lg-4 col-md-4">              
            <img src="{$base_dir}img/img-dominios/domain_web.jpg" style="width: 100%;">            
			</div>
	</div>
</div>
<!-- </div> -->