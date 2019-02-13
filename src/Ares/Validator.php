<?php
namespace LukeArthur\Ares;

use LukeArthur\AresException;

/**
 * @author LukeArthur
 */
class Validator
{

    /**
     * @param $companyID
     * @return string
     * @throws AresException
     */
    public static function validateCompanyID($companyID): string
    {
        if ($companyID === null || !\is_numeric($companyID)) {
            throw new AresException("Company ID isn't numeric: " . $companyID);
        }

        $stringID = (string)$companyID;

        if (\strlen($stringID) > 8) {
            throw new AresException("Company ID exceeds maximum valid length: " . $companyID);
        }

        return $stringID;
    }

}
