<?php
class CartController extends CartControllerCore {
  /*
    * module: roanjacheckdomain
    * date: 2016-08-18 14:55:50
    * version: 1.0
    */
    protected function processDeleteProductInCart()
    {
     $product = new Product((int)$this->id_product);
     $category = new Category((int)$product->id_category_default, (int)$this->context->language->id);
     $category_tienda= new Category(14, (int)$this->context->language->id);

$categoria = $category->name;

     if($categoria==$category_tienda->name){

       if(isset($_COOKIE['dominios'])){
        $lista_dominios=unserialize($_COOKIE['dominios']);
         $nombre_dominio=explode(".",$product->name[1]);
        //  echo json_encode($nombre_dominio);
        //   die();
         for ($i=0; $i<=count($lista_dominios); $i++) {
              $dominio=explode(".", $lista_dominios[$i]);
            //  echo json_encode($lista_dominios[$i]);

              if($dominio[1]==$nombre_dominio[1]){
                  unset($lista_dominios[$i]);
                }
           }


           if(!empty($lista_dominios)){
              setcookie('dominios', serialize($lista_dominios), time()+3600*24*30,'/');
            }else {
              setcookie('dominios', serialize($lista_dominios), time()-3600,'/');
            }

         }

     }
        $customization_product = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'customization`
		WHERE `id_cart` = '.(int)$this->context->cart->id.' AND `id_product` = '.(int)$this->id_product.' AND `id_customization` != '.(int)$this->customization_id);
        if (count($customization_product)) {
            $product = new Product((int)$this->id_product);
            if ($this->id_product_attribute > 0) {
                $minimal_quantity = (int)Attribute::getAttributeMinimalQty($this->id_product_attribute);
            } else {
                $minimal_quantity = (int)$product->minimal_quantity;
            }
            $total_quantity = 0;
            foreach ($customization_product as $custom) {
                $total_quantity += $custom['quantity'];
            }
            if ($total_quantity < $minimal_quantity) {
                $this->ajaxDie(Tools::jsonEncode(array(
                        'hasError' => true,
                        'errors' => array(sprintf(Tools::displayError('You must add %d minimum quantity', !Tools::getValue('ajax')), $minimal_quantity)),
                )));
            }
        }
        if ($this->context->cart->deleteProduct($this->id_product, $this->id_product_attribute, $this->customization_id, $this->id_address_delivery)) {
            Hook::exec('actionAfterDeleteProductInCart', array(
                'id_cart' => (int)$this->context->cart->id,
                'id_product' => (int)$this->id_product,
                'id_product_attribute' => (int)$this->id_product_attribute,
                'customization_id' => (int)$this->customization_id,
                'id_address_delivery' => (int)$this->id_address_delivery
            ));
            if (!Cart::getNbProducts((int)$this->context->cart->id)) {
                $this->context->cart->setDeliveryOption(null);
                $this->context->cart->gift = 0;
                $this->context->cart->gift_message = '';
                $this->context->cart->update();
            }
        }
        $removed = CartRule::autoRemoveFromCart();
        CartRule::autoAddToCart();
        if (count($removed) && (int)Tools::getValue('allow_refresh')) {
            $this->ajax_refresh = true;
        }
    }
}
