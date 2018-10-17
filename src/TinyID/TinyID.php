<?php

namespace TinyID;

use BCMathExtended\BC;

/**
 * Class TinyID
 * @package TinyID
 */
class TinyID
{
    /**
     * @var array
     */
    private $dictionary;
    /**
     * @var int
     */
    private $dictionaryLength;

    /**
     * TinyID constructor.
     * @param string $dictionary
     * @throws \InvalidArgumentException
     */
    public function __construct($dictionary)
    {
        $dictionaryLength = mb_strlen($dictionary, 'UTF-8');
        if ($dictionaryLength <= 1) {
            throw new \InvalidArgumentException('dictionary too short');
        }

        $this->dictionary = array_unique($this->stringSplit($dictionary));
        $this->dictionaryLength = count($this->dictionary);

        if ($dictionaryLength !== $this->dictionaryLength) {
            throw new \InvalidArgumentException('dictionary contains duplicated characters');
        }
    }

    /**
     * @param string $value
     * @return array[]|false|string[]
     */
    private function stringSplit($value)
    {
        return preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @param string $value
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encode($value)
    {
        if (BC::COMPARE_RIGHT_GRATER === BC::comp($value, '0')) {
            throw new \InvalidArgumentException('cannot encode negative number');
        }

        $encoded = '';
        do {
            $encoded = $this->dictionary[BC::mod($value, $this->dictionaryLength, 0)] . $encoded;
            $value = BC::div($value, $this->dictionaryLength, 0);
        } while ($value);


        return $encoded;
    }

    /**
     * @param string $value
     * @return string
     */
    public function decode($value)
    {
        $charsToPosition = array_flip($this->dictionary);
        $out = '0';
        foreach (array_reverse($this->stringSplit($value)) as $pos => $tmp) {
            if (!isset($charsToPosition[$tmp])) {
                throw new \InvalidArgumentException('cannot decode string with characters not in dictionary');
            }
            $out = BC::add($out, BC::mul($charsToPosition[$tmp], BC::pow($this->dictionaryLength, $pos, 0), 0), 0);
        }

        return $out;
    }
}
