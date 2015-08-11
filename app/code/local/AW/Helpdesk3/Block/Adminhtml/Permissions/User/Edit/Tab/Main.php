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
 * @package    AW_Helpdesk3
 * @version    3.3.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class Aw_Helpdesk3_Block_Adminhtml_Permissions_User_Edit_Tab_Main extends Mage_Adminhtml_Block_Permissions_User_Edit_Tab_Main
{

    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = $this->getForm();
        $field = $form->getElement('is_active');
        if (Mage::registry('permissions_user')->getId() && $field !== null) {
            if (Mage::helper('aw_hdu3/ticket')->isUserPrimaryAgent(Mage::registry('permissions_user')->getId())) {
                $field->setDisabled(true);
                $field->setNote($this->__('This user account is Primary Agent in one or more Help Desk departments and cannot be deleted or disabled'));
            }
            elseif (Mage::helper('aw_hdu3/ticket')->isUserHasTickets(Mage::registry('permissions_user')->getId())) {
                $field->setDisabled(true);
                $field->setNote($this->__('This user account has tickets assigned to it in Help Desk and cannot be deleted or disabled'));
            }
        }
        $this->setForm($form);
        return $this;
    }

}
