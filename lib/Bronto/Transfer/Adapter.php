<?php
/**
 * This file was generated by the ConvertToLegacy class in bronto-legacy.
 * The purpose of the conversion was to maintain PSR-0 compliance while
 * the main development focuses on modern styles found in PSR-4.
 *
 * For the original:
 * @see src/Bronto/Transfer/Adapter.php
 */

/**
 * Adapater factory to generate new transfer requests
 *
 * @author Philip Cali <philip.cali@bronto.com>
 */
interface Bronto_Transfer_Adapter
{
    /**
     * Initialize a request with a method and uri
     *
     * @param string $method
     * @param string $uri
     * @return Bronto_Transfer_Request
     */
    public function createRequest($method, $uri);
}
