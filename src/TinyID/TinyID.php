<?php
declare(strict_types=1);

namespace TinyID;

use BCMathExtended\BC;
use InvalidArgumentException;

class TinyID
{
    private $dictionary;
    private $dictionaryLength;

    public function __construct(string $dictionary)
    {
        $dictionaryLength = mb_strlen($dictionary, 'UTF-8');
        if ($dictionaryLength <= 1) {
            throw new InvalidArgumentException('dictionary too short');
        }

        $this->dictionary = $this->stringSplit($dictionary);
        $this->dictionaryLength = count(array_unique($this->dictionary));

        if ($dictionaryLength !== $this->dictionaryLength) {
            throw new InvalidArgumentException('dictionary contains duplicated characters');
        }
    }

    private function stringSplit(string $value): array
    {
        return (array)preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function encode(string $value): string
    {
        if (BC::COMPARE_RIGHT_GRATER === BC::comp($value, '0')) {
            throw new InvalidArgumentException('cannot encode negative number');
        }

        $encoded = '';
        do {
            $encoded = $this->dictionary[BC::mod($value, (string)$this->dictionaryLength, 0)] . $encoded;
            $value = BC::div($value, (string)$this->dictionaryLength, 0);
        } while ($value);

        return $encoded;
    }

    public function decode(string $value): string
    {
        $charsToPosition = array_flip($this->dictionary);
        $out = '0';
        foreach (array_reverse($this->stringSplit($value)) as $pos => $tmp) {
            if (!isset($charsToPosition[$tmp])) {
                throw new InvalidArgumentException('cannot decode string with characters not in dictionary');
            }
            $out = BC::add($out, BC::mul((string)$charsToPosition[$tmp], BC::pow((string)$this->dictionaryLength, (string)$pos, 0), 0), 0);
        }

        return $out;
    }
}