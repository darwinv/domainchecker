<?php 



if (!defined('_PS_VERSION_'))
 exit;


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
                $this->ps_versions_compliancy = array('min' => '1.6.0.14', 'max' => _PS_VERSION_);

                $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
            }


         
         public function install()
        {
             Configuration::updateValue('ROANJA_CHECKDOMAIN_NAME', "YourDomainSearcher");
            if(parent::install() && $this->registerHook('displayTopColumn') && $this->registerHook('displayHeader')
             && $this->createTable())
              return true;
         else 
          return false;
         }

 
         public function uninstall()
        {
           $res =  Configuration::deleteByName('ROANJA_CHECKDOMAIN_NAME');
          if (!parent::uninstall()) {

           $res &= $this->dropTables();
            return (bool)$res;
          }
            
          return true;
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

            return $output.$this->renderForm();
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

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    } 


 /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $vals=$this->getValTlds();

        return array(
            'ROANJA_CHECKDOMAIN_NAME' => Configuration::get('ROANJA_CHECKDOMAIN_NAME', "YourDomainSearcher"),
            'dominio_com'=>isset($vals[0]['active'])?$vals[0]['active']:1, 
            'dominio_net'=>isset($vals[1]['active'])?$vals[1]['active']:1,
            'dominio_org'=>isset($vals[2]['active'])?$vals[2]['active']:1,
            'dominio_info'=>isset($vals[3]['active'])?$vals[3]['active']:0,
            'dominio_edu'=>isset($vals[4]['active'])?$vals[4]['active']:0
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



    public function searchDomain($domain){
    
      $server="whois.crsnic.net";//"whois.crsnic.net"; 
      $findText="No match for"; //Can't get information
      $con = fsockopen($server, 43);
        if (!$con) return array("dominio"=>$domain,"disponible"=>false);
        
        // Send the requested doman name
        fputs($con, $domain."\r\n");
        
        // Read and store the server response
        $response = ':';
        while(!feof($con)) {
            $response .= fgets($con,128); 
        }
        
        // Close the connection
        fclose($con);
        
        // Check the response stream whether the domain is available
        if (strpos($response, $findText)){
            return array("dominio"=>$domain,"disponible"=>true);
        }
        else {
            return array("dominio"=>$domain,"disponible"=>false);   
        }
        
    }


    public function hookdisplayTopColumn()
        {
           $this->context->smarty->assign('nombre_check_domain',Configuration::get('ROANJA_CHECKDOMAIN_NAME'));
            
            return $this->display(__FILE__, 'form_domain.tpl', $this->getCacheId());
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
//echo $getMsgError();
           return $res;
        
        }

        public function getValTlds(){
        if ($results = Db::getInstance()->ExecuteS('
            SELECT * FROM '._DB_PREFIX_.'rj_checkdomain_tlds'))
             
              return $results;

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