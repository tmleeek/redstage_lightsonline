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
 * @package    AW_Advancedreports
 * @version    2.6.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Advancedreports_ChartController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('report/advancedreports');
    }

    public function ajaxBlockAction()
    {
        $width = $this->getRequest()->getParam('width');
        $block = $this->getRequest()->getParam('block');
        $option = $this->getRequest()->getParam('option');
        $type = $this->getRequest()->getParam('type');
        $output = $this->getLayout()->createBlock('advancedreports/chart')
            ->setType($type)
            ->setOption($option)
            ->setWidth($width)
            ->setRouteOption($block)
            ->setHeight(Mage::helper('advancedreports')->getChartHeight())
            ->toHtml()
        ;
        $this->getResponse()->setBody($output);
        return;
    }

    public function tunnelAction()
    {
        if ($h = $this->getRequest()->getParam('h')) {
            $params = unserialize(urldecode(base64_decode($h)));
            $httpClient = new Zend_Http_Client(AW_Advancedreports_Block_Chart::API_URL);
            $response = $httpClient->setParameterGet($params)->request('GET');
            $headers = $response->getHeaders();
            $this->getResponse()
                ->setHeader('Content-type', $headers['Content-type'])
                ->setBody($response->getBody());
            return;
        }
    }
}