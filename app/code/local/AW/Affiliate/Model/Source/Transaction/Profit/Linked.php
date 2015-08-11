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


class AW_Affiliate_Model_Source_Transaction_Profit_Linked extends AW_Affiliate_Model_Source_Abstract
{
    const ORDER_ITEM = 'order_item';
    const INVOICE_ITEM = 'invoice_item';

    const ORDER_ITEM_LABEL = 'Order Item';
    const INVOICE_ITEM_LABEL = 'Invoice Item';

    public function toOptionArray()
    {
        $helper = $this->_getHelper();
        return array(
            array('value' => self::ORDER_ITEM, 'label' => $helper->__(self::ORDER_ITEM_LABEL)),
            array('value' => self::INVOICE_ITEM, 'label' => $helper->__(self::ORDER_ITEM_LABEL))
        );
    }
}
