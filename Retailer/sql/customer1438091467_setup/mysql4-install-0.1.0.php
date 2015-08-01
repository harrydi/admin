<?php
/**
 * Installer script to create customer attribute
 */
$installer = $this;
$installer->startSetup();
/* new customer attribute business_billing_name  starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "business_billing_name", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Business Billing Name",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Business Billing Name",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "business_billing_name");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'business_billing_name', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute business_billing_name  ends */
/* new customer attribute DBA  starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "dba_info", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "DBA",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : DBA",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "dba_info");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'dba_info', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute DBA ends */
/* new customer attribute Owner starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "owner", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Owner",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Owner",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'owner', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Owner  ends */
/* new customer attribute Contact starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "contact", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Contact",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Contact",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "contact");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'contact', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Contact  ends */
/* new customer attribute Accts Paybale Contact starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "accts_paybale_contact", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Accts Paybale Contact",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Accts Paybale Contact",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("accts_paybale_contact", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'accts_paybale_contact', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Accts Paybale Contact  ends */
/* new customer attribute Buyers Name starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "buyers_name", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Buyers Name",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Buyers Name",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("buyers_name", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'buyers_name', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Buyers Name  ends */
/* new customer attribute Website starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "website", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Website",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Website",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("website", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'website', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Website  ends */
/* new customer attribute Seller Permit Number starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "accts_paybale_contact", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Accts Paybale Contact",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Accts Paybale Contact",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("accts_paybale_contact", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'accts_paybale_contact', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Accts Paybale Contact  ends */
/* new customer attribute Accts Paybale Contact starts */
	$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
	$entityTypeId = $setup->getEntityTypeId('customer');
	$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
	$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

	$installer->addAttribute("customer", "accts_paybale_contact", array(
		"type" => "varchar",
		"backend" => "",
		"label" => "Accts Paybale Contact",
		"input" => "text",
		"visible" => true,
		"required" => false,
		"default" => "",
		"frontend" => "",
		"unique" => false,
		"note" => "Retailer : Accts Paybale Contact",
	));
	$attribute = Mage::getSingleton("eav/config")->getAttribute("accts_paybale_contact", "owner");
	$setup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, 'accts_paybale_contact', '999');
	$used_in_forms = array();

	$used_in_forms[] = "adminhtml_customer";
	$attribute->setData("used_in_forms", $used_in_forms)
			->setData("is_used_for_customer_segment", true)
			->setData("is_system", 0)
			->setData("is_user_defined", 1)
			->setData("is_visible", 1)
			->setData("sort_order", 100);
	$attribute->save();
/* new customer attribute Accts Paybale Contact  ends */
$installer->endSetup();