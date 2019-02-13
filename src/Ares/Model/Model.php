<?php
namespace LukeArthur\Ares\Model;

use LukeArthur\AresException;

/**
 * @author LukeArthur
 */
abstract class Model
{
    protected const MAP_ATTR_NAME = "name";
    protected const MAP_ATTR_TYPE = "type";

    protected const TYPE_INT = "int";
    protected const TYPE_STRING = "string";
    protected const TYPE_DATETIME = "dateTime";
    protected const TYPE_OBJECT = "object";

    // TODO: magické get set?

    public abstract function parse(\SimpleXMLElement $xml);

    protected function setViaMap(array $map, string $attribute, $value) {
        if (!\array_key_exists($attribute, $map)) {
            //TODO: log nebo něco? není důvod ukončit běh
            //throw new AresException("Attribute %s not found");
        } else {
            $attrName = $map[$attribute][static::MAP_ATTR_NAME];
            $attrType = $map[$attribute][static::MAP_ATTR_TYPE];

            if ($attrType === static::TYPE_DATETIME) {
                $dateTimeString = \explode("T", $value);
                $date = \DateTime::createFromFormat("Y-m-d H:i:s", $dateTimeString[0] . " " . $dateTimeString[1]);
                $this->{$attrName} = $date;
            } elseif ($attrType === static::TYPE_INT) {
                $this->{$attrName} = (int) $value;
            } elseif ($attrType === static::TYPE_OBJECT) {
                $this->{$attrName} = $value;
            } else {
                $this->{$attrName} = (string) $value;
            }
        }
    }
}
