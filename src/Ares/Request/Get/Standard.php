<?php
namespace LukeArthur\Ares\Request\Get;

use LukeArthur\Ares\Validator;
use LukeArthur\AresException;

/**
 * @author  LukeArthur
 */
class Standard extends GetRequest
{

    protected const BASE_URL = "http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_std.cgi?";

    /**
     * @param $companyID
     * @return \SimpleXMLElement
     * @throws AresException
     */
    public function searchByCompanyID($companyID)
    {
        return $this->search(static::BASE_URL . "ico=" . Validator::validateCompanyID($companyID));
    }

}
