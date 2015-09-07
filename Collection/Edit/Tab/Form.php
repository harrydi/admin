<?php
class Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

			$form = new Varien_Data_Form();
			$enabledisable = Mage::getModel('adminhtml/system_config_source_enabledisable')->toOptionArray();
			foreach(Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Grid::getOptionArray1() as $val){
					$data_array[] =  $val;
				}
				?>
				<script>
					jQuery(function() {
						var availableTags = <?php echo json_encode($data_array); ?>;
						jQuery( "#attribute_option_label" ).autocomplete({
							source: availableTags
						});
					});
				</script>
			<?php
				$this->setForm($form);
				$fieldset = $form->addFieldset("custommenu_form", array("legend"=>Mage::helper("custommenu")->__("Item information")));

					$fieldset->addField('attribute_option_label', 'text', array(
						'label'     => Mage::helper('custommenu')->__('Add option'),
						'name' => 'attribute_option_label',
					));
					
					$fieldset->addField('image', 'image', array(
						'label' => Mage::helper('custommenu')->__('Image'),
						'name' => 'image',
						'note' => '(*.jpg, *.png, *.gif)',
					));
					
					$fieldset->addField("description", "textarea", array(
						"label" => Mage::helper("custommenu")->__("Description"),
						"name" => "description",
					));
					
					$fieldset->addField("sortorder", "text", array(
						"label" => Mage::helper("custommenu")->__("Sort Order"),
						"name" => "sortorder",
					));
				
					$fieldset->addField('status', 'select', array(
						'name' => 'status',
						'label' => Mage::helper('custommenu')->__('Status'),
						'title' => Mage::helper('custommenu')->__('Status'),
						'value' => '1',
						'values' => $enabledisable,
					));
					
				if (Mage::getSingleton("adminhtml/session")->getCollectionData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCollectionData());
					Mage::getSingleton("adminhtml/session")->setCollectionData(null);
				} 
				elseif(Mage::registry("collection_data")) {
				    $form->setValues(Mage::registry("collection_data")->getData());
				}
				return parent::_prepareForm();
		}
}
