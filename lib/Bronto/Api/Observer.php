<?php
/**
 * This file was generated by the ConvertToLegacy class in bronto-legacy.
 * The purpose of the conversion was to maintain PSR-0 compliance while
 * the main development focuses on modern styles found in PSR-4.
 *
 * For the original:
 * @see src/Bronto/Api/Observer.php
 */

/**
 * General login and failure observation
 *
 * @author Philip Cali <philip.cali@bronto.com>
 */
interface Bronto_Api_Observer
{
    /**
     * Called whenever there's an implicit or explicit API login
     *
     * @param string $apiToken
     * @param string $sessionId
     * @return void
     */
    public function onLogin($apiToken, $sessionId);

    /**
     * Called whenever an API exception is about to be thrown
     *
     * @param Bronto_Api $api
     * @param Bronto_Api_Exception $exception
     * @return void
     */
    public function onError(Bronto_Api $api, Bronto_Api_Exception $exception);
}