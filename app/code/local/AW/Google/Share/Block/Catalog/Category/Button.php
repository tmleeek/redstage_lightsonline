<?php

class AW_Google_Share_Block_Catalog_Category_Button extends AW_Google_Share_Block_Abstract
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowInCategoryPage()){
            return parent::_toHtml().$this->_getHelper()->getGoogleJsHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Google_Share_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleshare');
    }
}