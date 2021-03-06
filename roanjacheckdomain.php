<?php



if (!defined('_PS_VERSION_'))
 exit;



//include_once(_PS_MODULE_DIR_.'homeslider/HomeSlide.php');


class RoanjaCheckDomain extends Module {



        public function __construct()
            {
                $this->name = 'roanjacheckdomain';
                $this->tab = 'checkout';
                $this->version = '1.0';
                $this->author = 'Roanja Company';
                $this->need_instance = 0;
              //  $this->secure_key = Tools::encrypt($this->name);
                $this->bootstrap = true;

                parent::__construct();

                $this->displayName = $this->l('Roanja Domain Checker');
                $this->description = $this->l('With this module, your customers will be able to check the available domains');
                $this->ps_versions_compliancy = array('min' => _PS_VERSION_, 'max' => _PS_VERSION_);

                $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
            }



         public function install()
        {
             Configuration::updateValue('ROANJA_CHECKDOMAIN_NAME', "YourDomainSearcher");
            if(parent::install() && $this->registerHook('home') && $this->registerHook('displayHeader')
             && $this->createTable())
              return true;
         else
          return false;
         }


         public function uninstall()
        {
           $res =  Configuration::deleteByName('ROANJA_CHECKDOMAIN_NAME');
        Db::getInstance()->execute('DROP TABLE '._DB_PREFIX_.'rj_checkdomain_tlds');

        return parent::uninstall();

        }




        public function getContent()
        {
            /**
         * If values have been submitted in the form, process.
         */

            if (((bool)Tools::isSubmit('submitcheckdomain')) == true) {
                $this->postProcess();
            }


            $this->context->smarty->assign('module_dir', $this->_path);
            // $nombre=Configuration::get('ROANJA_CHECKDOMAIN_NAME')

          $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
          $output = $this->renderForm();
            return $output;
        }



protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitcheckdomain';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }


       /**
     * Guarda data del formulario
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

       /* foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }*/
        Configuration::updateValue('ROANJA_CHECKDOMAIN_NAME',Tools::getValue('ROANJA_CHECKDOMAIN_NAME'));

        $this->updateTld("com",Tools::getValue('dominio_com_on'));
       $this->updateTld("net",Tools::getValue('dominio_net_on'));
        $this->updateTld("org",Tools::getValue('dominio_org_on'));
        $this->updateTld("info",Tools::getValue('dominio_info_on'));
        $this->updateTld("edu",Tools::getValue('dominio_edu_on'));
        $this->updateTld("es",Tools::getValue('dominio_es_on'));
        $this->updateTld("com.ve",Tools::getValue('dominio_comve_on'));
        $this->updateTld("org.ve",Tools::getValue('dominio_orgve_on'));
        $this->updateTld("net.ve",Tools::getValue('dominio_netve_on'));
        //echo $form_values["ROANJA_CHECKDOMAIN_NAME"];
    }


 /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $vals=$this->getValTlds();

        return array(
            'ROANJA_CHECKDOMAIN_NAME' => Configuration::get('ROANJA_CHECKDOMAIN_NAME', "YourDomainSearcher"),
           'dominio_com_on'=>isset($vals[0]['active'])?$vals[0]['active']:1,
            'dominio_net_on'=>isset($vals[1]['active'])?$vals[1]['active']:1,
            'dominio_org_on'=>isset($vals[2]['active'])?$vals[2]['active']:1,
            'dominio_edu_on'=>isset($vals[3]['active'])?$vals[3]['active']:0,
            'dominio_info_on'=>isset($vals[4]['active'])?$vals[4]['active']:0,
            'dominio_es_on'=>isset($vals[5]['active'])?$vals[5]['active']:0,
            'dominio_comve_on'=>isset($vals[6]['active'])?$vals[6]['active']:0,
            'dominio_orgve_on'=>isset($vals[7]['active'])?$vals[7]['active']:0,
            'dominio_netve_on'=>isset($vals[8]['active'])?$vals[8]['active']:0
        );
    }



    protected function getConfigForm()
    {

        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                     array(
                        'col' => 3,
                        'type' => 'text',
                        'desc' => $this->l('Enter the name of the domain checker'),
                        'name' => 'ROANJA_CHECKDOMAIN_NAME',
                        'label' => $this->l('Name'),
                    ),
                     array(
                    'type' => 'checkbox',
                    'name' => 'dominio_com',
                    'label' => $this->l('Enable .com'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'checkbox',
                    'name' => 'dominio_net',
                    'label' => $this->l('Enable .net'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                 array(
                    'type' => 'checkbox',
                    'name' => 'dominio_org',
                    'label' => $this->l('Enable .org'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),

                 array(
                    'type' => 'checkbox',
                    'name' => 'dominio_edu',
                    'label' => $this->l('Enable .edu'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),

                 array(
                    'type' => 'checkbox',
                    'name' => 'dominio_info',
                    'label' => $this->l('Enable .info'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),

                array(
                   'type' => 'checkbox',
                   'name' => 'dominio_comve',
                   'label' => $this->l('Enable .com.ve'),
                   'values' => array(
                       'query' => array(
                           array(
                               'id' => 'on',
                               'val' => '1'
                           ),
                       ),
                       'id' => 'id',
                       'name' => 'name'
                   )
               ),

               array(
                  'type' => 'checkbox',
                  'name' => 'dominio_orgve',
                  'label' => $this->l('Enable .org.ve'),
                  'values' => array(
                      'query' => array(
                          array(
                              'id' => 'on',
                              'val' => '1'
                          ),
                      ),
                      'id' => 'id',
                      'name' => 'name'
                  )
              ),

              array(
                 'type' => 'checkbox',
                 'name' => 'dominio_netve',
                 'label' => $this->l('Enable .net.ve'),
                 'values' => array(
                     'query' => array(
                         array(
                             'id' => 'on',
                             'val' => '1'
                         ),
                     ),
                     'id' => 'id',
                     'name' => 'name'
                 )
             ),

                 array(
                    'type' => 'checkbox',
                    'name' => 'dominio_es',
                    'label' => $this->l('Enable .es'),
                    'values' => array(
                        'query' => array(
                            array(
                                'id' => 'on',
                                'val' => '1'
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                )
        ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
             ),
        );
    }



 /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookdisplayHeader()
    {
        $this->context->controller->addJS($this->_path.'/js/roanjacheckdomain.js');
        $this->context->controller->addCSS($this->_path.'/css/roanjacheckdomain.css');
    }

public function hookdisplayTopColumn()
{
  $this->context->smarty->assign('nombre_check_domain',Configuration::get('ROANJA_CHECKDOMAIN_NAME'));

   return $this->display(__FILE__, 'form_domain_2.tpl', $this->getCacheId());
}

    public function getActivesTld(){
                 if ($results = Db::getInstance()->ExecuteS('
                 SELECT name_tld FROM '._DB_PREFIX_.'rj_checkdomain_tlds WHERE active =  1' ))

                 return $results;
        }


 public function searchDomainNew($domain){
        require_once(_PS_MODULE_DIR_.'roanjacheckdomain/checkfix.php');
                 $tlds=$this->getActivesTld();
                 $i=0;

        foreach ($tlds as $tld){
                $sutld=".".$tld['name_tld'];
                $datatlds=$this->getDataTldProduct($sutld);

       $this->product = new Product($datatlds[0]['id_product'], false,$this->context->language->id);
                $precioconv=Tools::convertPrice($this->product->price, $this->context->currency);
                $arrdata[$i]["precio"]=number_format($precioconv, 2, ",", "");

                $arrdata[$i]['id_producto']=$datatlds[0]['id_product'];
                $arrdata[$i]['sign']=$this->context->currency->sign;
                $domaincomplet=$domain.".".$tld['name_tld'];

                $arrdata[$i]["dominio"]=$domaincomplet;
                $valor='&amp;';
                $val=html_entity_decode($valor);
$arrdata[$i]["url_cart"]=$this->context->link->getPageLink('cart',false,NULL,'add=1'.$valor.'id_product='.$datatlds[0]['id_product'].'','false');
                if($service->isAvailable($domaincomplet))
                    $arrdata[$i]["estado"]="disponible";
                else
                    $arrdata[$i]["estado"]="no disponible";

                $i++;
        }//fin del foreach

      return $arrdata;
    }



    public function hookHome()
        {
           $this->context->smarty->assign('nombre_check_domain',Configuration::get('ROANJA_CHECKDOMAIN_NAME'));

            return $this->display(__FILE__, 'form_domain.tpl', $this->getCacheId());
        }


public function updateCart($idproducto)
{
    //$this->product = new Product($idproducto, false,$this->context->language->id);
   //$val=$this->context->cart->updateQty(1, $idproducto);
    return array("result"=>t);

}

public function deleteProductCart($idproducto){


}

public function getDataTldProduct($tld){

    if($results= Db::getInstance()->ExecuteS('
                 SELECT pr.id_product
                  FROM '._DB_PREFIX_.'product pr
                  Inner Join '._DB_PREFIX_.'product_lang pl ON (pl.id_product=pr.id_product)
                  WHERE pl.name="'.$tld.'" AND pl.id_shop='.(int)$this->context->shop->id.'
                  LIMIT 1 ' ));

        return $results;
}


        /* Create the tables for the checkboxes of tlds */
        protected function createTable(){

            $res = (bool)Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rj_checkdomain_tlds` (
                `id_tld` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `name_tld` varchar(12) NOT NULL,
                `active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
                PRIMARY KEY (`id_tld`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;

             ');

            $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'com',
            'active' => 1,
             ));

            $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'net',
            'active' => 1,
             ));

            $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'org',
            'active' => 1,
             ));

             $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'edu',
            'active' => 0,
             ));

              $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'info',
            'active' => 0,
             ));

               $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
            'name_tld' => 'es',
            'active' => 0,
             ));

             $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
          'name_tld' => 'com.ve',
          'active' => 0,
           ));

           $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
        'name_tld' => 'org.ve',
        'active' => 0,
         ));

         $res &= Db::getInstance()->insert('rj_checkdomain_tlds', array(
      'name_tld' => 'net.ve',
      'active' => 0,
       ));
//echo $getMsgError();
           return $res;

        }


public function getValTlds(){

        if ($results = Db::getInstance()->ExecuteS('
            SELECT * FROM '._DB_PREFIX_.'rj_checkdomain_tlds'))

              return $results;

        }


public function updateTld($name, $val){
    //echo $name ." - ".$val;


    $res=Db::getInstance()->update('rj_checkdomain_tlds', array(
            'active'=>$val
            ),
    //'name_tld='.$name
        "name_tld = "."'$name'"
        );
//die();
    return $res;
}


public function deleteTable(){

    return Db::getInstance()->execute('
            DROP TABLE IF EXISTS `'._DB_PREFIX_.'rj_checkdomain_tlds`;
        ');

}

public static function dropTables()
    {
        $sql = 'DROP TABLE
            `'._DB_PREFIX_.'rj_checkdomain_tlds`';

        return Db::getInstance()->execute($sql);
    }





}
