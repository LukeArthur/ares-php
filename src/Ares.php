<?php
namespace LukeArthur;

use LukeArthur\Ares\Request\Get\Standard;

/**
 * @author LukeArthur
 */
class Ares
{
    /**
     * @var \LukeArthur\Ares\Request\Get\Standard
     */
    protected $standardRequest;

    /**
     * @var \LukeArthur\Ares\Response\Get\Standard
     */
    protected $standardResponse;

    public function standardRequest()
    {
        return ($this->standardRequest !== null) ? $this->standardRequest : new Standard();
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    public function parseStandardResponse(\SimpleXMLElement $xml)
    {
        $response = ($this->standardResponse !== null) ? $this->standardResponse : new \LukeArthur\Ares\Response\Get\Standard();

        return $response->parseXml($xml);

    }
}
