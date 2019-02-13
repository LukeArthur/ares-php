<?php
namespace LukeArthur\Ares\Model\AresAnswer\v_1_0_1;

use LukeArthur\Ares\Model\Model;
use LukeArthur\AresException;

/**
 * Ares_odpovedi
 * @author LukeArthur
 */
class AresAnswers extends Model
{

    public const PATH = "/are:Ares_odpovedi";

    protected const ATTRIBUTE_MAP = [
        "odpoved_datum_cas" => [self::MAP_ATTR_NAME => "dateTime", self::MAP_ATTR_TYPE => self::TYPE_DATETIME],
        "odpoved_pocet" => [self::MAP_ATTR_NAME => "count", self::MAP_ATTR_TYPE => self::TYPE_INT],
        "odpoved_typ" => [self::MAP_ATTR_NAME => "type", self::MAP_ATTR_TYPE => self::TYPE_STRING],
        "vystup_format" => [self::MAP_ATTR_NAME => "format", self::MAP_ATTR_TYPE => self::TYPE_STRING],
        "Id" => [self::MAP_ATTR_NAME => "id", self::MAP_ATTR_TYPE => self::TYPE_STRING],
    ];

    protected $dateTime;

    protected $count;

    protected $type;

    protected $format;

    protected $id;

    protected $answers = [];

    protected $fault;

    public function parse(\SimpleXMLElement $xml)
    {
        // TODO: Fault

        $root = $xml->xpath(static::PATH);

        if ($root[0] instanceof \SimpleXMLElement) {
            foreach ($root[0]->attributes() as $attribute) {
                $this->setViaMap(static::ATTRIBUTE_MAP, $attribute->getName(), $attribute);
            }

            $answers = $xml->xpath(static::PATH . Answer::PATH);

            foreach ($answers as $answer) {
                $this->answers[] = (new Answer())->parse($answer);
            }
        }


        if ($root === false) {
            throw new AresException("Root element missing");
        }

        \var_dump($this);
    }

    /**
     * odpoved_datum_cas
     * @return \DateTime|null
     */
    public function getDateTime(): ?\DateTime
    {
        return $this->dateTime;
    }

    /**
     * odpoved_pocet
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * odpoved_typ
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * odpoved_format
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Id
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \LukeArthur\Ares\Model\AresAnswer\v_1_0_1\Answer[]
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @return \LukeArthur\Ares\Model\AresAnswer\v_1_0_1\Fault|null
     */
    public function getFault()
    {
        return $this->fault;
    }
}
