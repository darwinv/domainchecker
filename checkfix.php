<?php 

require_once(_PS_MODULE_DIR_.'roanjacheckdomain/vendor/autoload.php');

//include_once(_PS_MODULE_DIR_.'homeslider/HomeSlide.php');
use Helge\Loader\JsonLoader;
use Helge\Client\SimpleWhoisClient;
use Helge\Service\DomainAvailability;

		
$whoisClient = new SimpleWhoisClient();
$dataLoader = new JsonLoader("src/data/servers.json");
$service = new DomainAvailability($whoisClient, $dataLoader);

