<?php
/**
 * This file was generated by the ConvertToLegacy class in bronto-legacy.
 * The purpose of the conversion was to maintain PSR-0 compliance while
 * the main development focuses on modern styles found in PSR-4.
 *
 * For the original:
 * @see src/Bronto/Transfer/Curl/Multi.php
 */

/**
 * Simple wrapper class around curl_multi
 *
 * @author philip Cali <philip.cali@bronto.com>
 */
class Bronto_Transfer_Curl_Multi
{
    protected $_multi;
    protected $_requests;
    protected $_threshold = 10;
    protected $_executeEagerly = true;
    protected $_error;

    /**
     * Create a multi wrapper, optionally with a proxy object
     *
     * @param mixed $multi
     */
    public function __construct($multi = null)
    {
        $this->_multi = $multi ? $multi : new Bronto_Resource_Proxy('curl_multi_');
        $this->_multi->addExcluded('getcontent');
        $this->_multi->init();
    }

    /**
     * Set the max number of concurrent connections
     * Note: This also sets the reaper threshold
     *
     * @param int $cons
     * @return self
     */
    public function setMaxConnections($cons)
    {
        if (function_exists('curl_multi_setopt')) {
            $this->_multi->setopt(CURLMOPT_MAXCONNECTS, $cons);
        }
        $this->_threshold = $cons;
        return $this;
    }

    /**
     * Designate connection pool pipe-lining
     *
     * @param boolean
     * @return self
     */
    public function setPipeLining($pipeLining)
    {
        $this->_multi->setopt(CURLMOPT_PIPELINING, $pipeLining);
        return $this;
    }

    /**
     * Flag to execute eagerly or not
     *
     * @param boolean $boolean
     * @return self
     */
    public function setExecuteEagerly($boolean)
    {
        $this->_executeEagerly = $boolean;
        return $this;
    }

    /**
     * Add a request to the multi handle
     *
     * @param Bronto_Transfer_Curl_Request $request
     * @return self
     */
    public function add(Bronto_Transfer_Curl_Request $request)
    {
        $handle = $request->prepare()->getHandle();
        $this->_requests[(int)$handle->getResource()] = $request;
        $this->_multi->addHandle($handle->getResource());
        if ($this->_executeEagerly) {
            $running = 0;
            $this->_multi->byRef('exec', $running);
        }
        // Reap enough to clear out the threshold
        if (count($this->_requests) > $this->_threshold) {
            $this->complete($this->_threshold);
        }
        return $this;
    }

    /**
     * Remove a request from the multi handle
     *
     * @param Bronto_Transfer_Curl_Request $request
     * @return self
     */
    public function remove(Bronto_Transfer_Curl_Request $request)
    {
        $this->_multi->removeHandle($request->getHandle()->getResource());
        unset($this->_requests[(int)$request->getHandle()->getResource()]);
        return $this;
    }

    /**
     * Block, scan, and reap a certain number of requests
     *
     * @param $threshold
     */
    public function complete($threshold = 0)
    {
        $running = 0;
        do {
            $this->_multi->byRef('exec', $running);
        } while ($running > $threshold);
        $this->_scanAndReap();
    }

    /**
     * Typical scap and reaper for threaded cURL requests
     */
    protected function _scanAndReap()
    {
        while ($info = $this->_multi->infoRead()) {
            $handle = $info['handle'];
            $result = $info['result'];
            $request = $this->_requests[(int)$handle];

            if ($result !== CURLE_OK) {
                $message = $request->getHandle()->error();
                $request->error(new Bronto_Transfer_Exception($message, $result, $request));
            } else {
                $content = $this->_multi->getcontent($handle);
                $info = $request->getHandle()->getinfo();
                $request->complete(new Bronto_Transfer_Curl_Response($content, $info));
            }
            $this->remove($request);
        }
    }
}
