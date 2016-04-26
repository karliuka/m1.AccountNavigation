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
class Faonni_AccountNavigation_Model_Observer
{
    /**
     * XPath query list
     *
     * @var array
     */
	protected $_xpath = array(
		"//block[@name='customer_account_navigation']",
		"//reference[@name='customer_account_navigation']"
	);

    /**
     * Prepare layout
     *
     * @param   Varien_Event_Observer $observer
     * @return  Faonni_AccountNavigation_Model_Observer
     */
	public function prepareLayout(Varien_Event_Observer $observer)
	{
		if (!Mage::helper('faonni_accountnavigation')->isEnabled()) {
            return $this;
        }
		/** @var $layout Mage_Core_Model_Layout */
		$layout = $observer->getEvent()->getLayout();
		$disabledLinks = Mage::helper('faonni_accountnavigation')->getDisabledLinks();

		foreach ($this->_xpath as $xpath) {
			$xml = $layout->getNode()->xpath($xpath);
			if (!$xml) continue;
			foreach ($xml as $node) {
				if (empty($node->action)) continue;
				foreach ($node->action as $action) {
					if (!empty($action->attributes()->method) && (string)$action->attributes()->method == 'addLink') {
						if (!empty($action->name) && in_array((string)$action->name, $disabledLinks)) {
							$action->addAttribute('ignore', true);
						}	
					}						
				}				
			}	
		}
		return $this;
	}
}