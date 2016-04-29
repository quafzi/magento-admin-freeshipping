<?php
/**
 * Quafzi_AdminFreeShipping
 *
 * This file is part of the Quafzi_AdminFreeShipping extension.
 * Please do not edit or add to this file if you wish to upgrade it to newer
 * versions in the future.
 *
 * @category   Quafzi_AdminFreeShipping
 * @package    Quafzi_AdminFreeShipping
 * @copyright  © 2016 by Thomas Birke <magento@netextreme.de>
 * @license    OSL
 */

/**
 * Free shipping model for backend use, only
 *
 * @author     Thomas Birke <magento@netextreme.de>
 */
class Quafzi_AdminFreeShipping_Model_Carrier_Freeshipping
    extends Mage_Shipping_Model_Carrier_Freeshipping
{

    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'admin_freeshipping';

    /**
     * Whether this carrier has fixed rates calculation
     *
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * FreeShipping Rates Collector
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        if (!Mage::helper('adminhtml')->getCurrentUserId()) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');

        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier('admin_freeshipping');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('admin_freeshipping');
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice('0.00');
        $method->setCost('0.00');

        $result->append($method);

        return $result;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array('admin_freeshipping' => $this->getConfigData('name'));
    }

}
