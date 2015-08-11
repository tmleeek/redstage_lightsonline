<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento enterprise edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Affiliate
 * @version    1.1.1
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Affiliate_Model_Traffic_Source extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('awaffiliate/traffic_source');
    }

    public function loadByAffiliateAndName($affiliateId, $name)
    {
        /** @var $collection AW_Affiliate_Model_Resource_Traffic_Source_Collection */
        $collection = Mage::getModel('awaffiliate/traffic_source')->getCollection();
        $collection->addFieldToFilter('affiliate_id', array('eq' => $affiliateId))
            ->addFieldToFilter('traffic_name', array('eq' => $name));
        $trafficSource = $collection->getFirstItem();
        if (!$trafficSource->getId()) {
            $trafficSource->setData(array(
                'affiliate_id' => $affiliateId,
                'traffic_name' => $name
            ));
        }
        return $trafficSource;
    }
}
