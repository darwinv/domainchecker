<?php
/*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @since 1.5.0
 */
class RoanjaCheckDomainPageDomainModuleFrontController extends ModuleFrontController
{

	public function initContent(){
		parent::initContent();
		/*$domain=Tools::getValue('domain');
		$module_action=Tools::getValue('method');
		$action_list = array('ajaxlist'=>'initAjaxList',
			'newpage'=>'initNewPage');*/
        $this->context->smarty->assign('ruta_img', $this->module->getLocalPath().'reload.gif');
         $this->context->smarty->assign('ruta_modulo', $this->module->getLocalPath());
		$this->setTemplate('view_domains.tpl');
	  }

	  protected function initAjaxList(){

	  }

	  protected function initNewPage(){

	  }

	  public function setMedia(){
	  	parent::setMedia();
$this->context->controller->addJS($this->module->getLocalPath().'js/checkdomain.js');
	  //	$this->path=_PS_MODULE_DIR_.'modules/roanjacheckdomain/';

	  //	$this->context->controller->addJS($this->path.'js/checkdomain.js');
	  }
}