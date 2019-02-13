<?php
namespace LukeArthur\Ares\Response\Get;

use LukeArthur\Ares\Model\AresAnswer\v_1_0_1\AresAnswers;
use LukeArthur\AresException;

/**
 * @author LukeArthur
 */
class Standard
{

    public function parseXml(\SimpleXMLElement $xml)
    {
        //TODO parse do modelů dle verze, kontrola jestli xml a počet odpovědí
        return (new AresAnswers())->parse($xml);
    }

}
