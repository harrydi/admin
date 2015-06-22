<?php
/*------------------------------------------------------------------------
 # SM Slick Slider - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
-------------------------------------------------------------------------*/

class Smartaddons_Slickslider_Helper_Data extends Mage_Core_Helper_Abstract {
	public function __construct(){
		$this->defaults = array(
			/* general options */
			'isenabled'		=> '1',
			'title' 		=> 'SM Slickslider',
			/* Module options */
			'module_width' 		=> '',
			'theme' 			=> 'theme1',	
			/* Slickslider options*/
			'autoplay'								=> '1',			//auto_play
			'show_img_on_right'						=> '1',
			'button_theme'							=> 'number',
			'prenext_show'							=> '1',
			'animation'								=> 'fade',		//effect
			'duration'								=> '2000',		//slideshow_speed
			//'control'								=> '1',
			'interval'								=> '500',		//timer_speed
			'play'									=> '1',	
			'desc_box_width'						=> '300',
			'start_item'							=> '1',			//start
			
			/* product query */
			'product_source'		=> 'catalog',		//datatype	
			'product_category' 		=> array(),			//catsid	
			'product_ids'			=> '',
			'product_order_by'		=> '',					
			'product_order_dir' 	=> '',					
			'product_limitation' 	=> '10',  			//quantityItems				
			

			/* product images */
			'product_image_disp'	=> '1',
			'product_image_linkable'=> '1',				//link_image
			'product_image_width'	=> '300',			//thumb_width
			'product_image_height'	=> '250',			//thumb_height
			
			/* product title */
			'product_title_disp'	=> '1',					//caption_show
			'product_title_linkable'=> '1',					//link_caption
			'product_title_color'	=> '#000000',			// title_color
			'product_title_max_characters'=> '50',			//limit_title

			/* description options*/	
			
			'product_description_disp' 				=> '1',			//show_description
			'product_description_color'				=> '#000000',		
			'product_description_max_characters' 	=> '100',		//limit_description
			//'show_description_when'					=> 'always',
			//'product_details_page_link_disp' 		=> '1',
			//'product_details_page_link_text' 		=> 'See details',
			
			/* other options*/		
			'product_links_target'					=> '_self',		//target
			'product_price_disp'					=> '1',			//show_price
			'product_details_page_link_disp'		=> '1',			//show_readmore
			/*jquery option*/
			'include_jquery'	=> '1',
			'pretext'			=> '',
			'posttext'			=> ''

			/**config_fields**/
		);
	}

	function get($attributes=array())
	{
		$data = $this->defaults;
		$general 					= Mage::getStoreConfig("slickslider_cfg/general");
		$module_setting				= Mage::getStoreConfig("slickslider_cfg/module_setting");
		$product_selection 			= Mage::getStoreConfig("slickslider_cfg/product_selection");
		$product_display_setting 	= Mage::getStoreConfig("slickslider_cfg/product_display_setting");
		$advanced 					= Mage::getStoreConfig("slickslider_cfg/advanced");
		if (!is_array($attributes)) {
			$attributes = array($attributes);
		}
		if (is_array($general))					$data = array_merge($data, $general);
		if (is_array($module_setting)) 			$data = array_merge($data, $module_setting);
		if (is_array($product_selection)) 		$data = array_merge($data, $product_selection);
		if (is_array($product_display_setting)) $data = array_merge($data, $product_display_setting);
		if (is_array($advanced)) 				$data = array_merge($data, $advanced);
		
		return array_merge($data, $attributes);;
	}
}
?>