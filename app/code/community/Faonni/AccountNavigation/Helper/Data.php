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
class Faonni_AccountNavigation_Helper_Data 
	extends Mage_Core_Helper_Abstract
{
    /**
	 * Account navigation link list
     *	 
     * @var array
     */
    protected $_link;
	
    /**
     * Check account navigation control functionality should be enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::helper('Core')->isModuleEnabled('Faonni_AccountNavigation') && 
			Mage::getStoreConfig('faonni_accountnavigation/general/active');
    }
	
    /**
     * Retrieve account navigation disabled link list
     *	 
     * @return array
     */
    public function getDisabledLinks()
    {
		$disabled = explode(',', Mage::getStoreConfig('faonni_accountnavigation/general/disabled_link'));
		$links = $this->getLinks();
		
		foreach($links as $key => $name){
			if(!in_array($key, $disabled)) unset($links[$key]);
		}
		return $links;
    }
	
    /**
     * Retrieve account navigation link list
     *	 
     * @return array
     */
    public function getLinks()
    {
        if(null === $this->_link){
			$node = Mage::app()->getConfig()
				->getNode('global/faonni_accountnavigation/link');
			$this->_link = $node->asArray();	
		}
		return $this->_link;
    }
}