<?php
/**
 * This file was generated by the ConvertToLegacy class in bronto-legacy.
 * The purpose of the conversion was to maintain PSR-0 compliance while
 * the main development focuses on modern styles found in PSR-4.
 *
 * For the original:
 * @see src/Bronto/Api/Operation/Conversion.php
 */


/**
 * Bronto_Api_Operation_Conversion specific Bronto_Api_Operation
 *
 * @author Philip Cali <philip.cali@bronto.com>
 */
class Bronto_Api_Operation_Conversion extends Bronto_Api_Operation
{
    /**
     * @see parent
     */
    public function __construct(Bronto_Api $api)
    {
        parent::__construct($api, 'Conversion', array('add'));
        $this->_writeLimit = 10;
    }
}
