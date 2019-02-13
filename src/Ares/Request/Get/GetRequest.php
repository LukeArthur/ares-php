<?php
namespace LukeArthur\Ares\Request\Get;

use LukeArthur\AresException;

/**
 * @author LukeArthur
 */
abstract class GetRequest
{

    public const HTTTP_RESPONSE_OK = 200;

    /**
     * @param string $url
     * @return \SimpleXMLElement
     * @throws AresException
     */
    protected function search(string $url)
    {
        $curl = \curl_init();
        \curl_setopt($curl, \CURLOPT_URL, $url);
        \curl_setopt($curl, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($curl, \CURLOPT_FAILONERROR, true);

        $data = \curl_exec($curl);
        $httpCode = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
        $error = \curl_error($curl);
        $errorNo = \curl_errno($curl);
        \curl_close($curl);

        if ($httpCode !== static::HTTTP_RESPONSE_OK || $error) {
            throw new AresException(\sprintf("Error during search - error message: %s, error number: %i, http code: %i", $error, $errorNo, $httpCode));
        }

        if ($data === false) {
            throw new AresException("No data received");
        }

        $xml = \simplexml_load_string($data);

        if ($xml === false) {
            throw new AresException("Xml error");
        }

        return $xml;
    }
}