<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_AccountNavigation
 * @copyright   Copyright (c) 2015 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Faonni_AccountNavigation_Model_Adminhtml_System_Config_Source_Link
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
		$options = array();
		foreach(Mage::helper('faonni_accountnavigation')->getLinks() as $key => $name){
			$options[] = array('value' => $key, 'label' => $name);
		}
		return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
		$options = array();
		foreach(Mage::helper('faonni_accountnavigation')->getLinks() as $key => $name){
			$options[$key] = $name;
		}
		return $options;	
    }
}