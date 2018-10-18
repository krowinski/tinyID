<?php

namespace TinyID\Tests\Unit;

use TinyID\TinyID;
use PHPUnit\Framework\TestCase;

/**
 * Class TinyIDTest
 * @package TinyID\Tests\Unit
 */
class TinyIDTest extends TestCase
{
    /**
     * @test
     */
    public function shortestKeyPossible()
    {
        $tinyId = new TinyID('ab');

        self::assertEquals('a', $tinyId->encode('0'));
        self::assertEquals('0', $tinyId->decode('a'));

        self::assertEquals('b', $tinyId->encode('1'));
        self::assertEquals('1', $tinyId->decode('b'));

        self::assertEquals('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', $tinyId->encode('18446744073709551615'));
        self::assertEquals('18446744073709551615', $tinyId->decode('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'));
    }

    /**
     * @test
     */
    public function accentSensitive()
    {
        $tinyId = new TinyID('ąä');

        self::assertEquals('äą', $tinyId->encode('2'));
        self::assertEquals('2', $tinyId->decode('äą'));
    }

    /**
     * @test
     */
    public function caseSensitive()
    {
        $tinyId = new TinyID('Aa');

        self::assertEquals('aA', $tinyId->encode('2'));
        self::assertEquals('2', $tinyId->decode('aA'));
    }


    /**
     * @test
     */
    public function alphanumericKey()
    {
        $tinyId = new TinyID('FujSBZHkPMincNQr6pq0mgxw2tXAsyb8DWV534EC1RUIlYoGOJhed9afKT7vzL');

        self::assertEquals('gzUp3uHipVr', $tinyId->encode('18446744073709551615'));
        self::assertEquals('18446744073709551615', $tinyId->decode('gzUp3uHipVr'));
    }

    /**
     * @test
     */
    public function veryLongUnicodeKey()
    {
        $tinyId
            = new TinyID('⊷⇑≩≔⊴⊖⢻⢬⇖⊙⣮≺⇋↨⣺∄⇫⊌⊍⢶∦⠢⋠⊜⋅⋾⊔⠅⣎⋥⠌⣋⢟⋕⇮∔↻⣃⢅≭⡆∕↩⇨⢺⇩∤⣝⇛↡⡖⡃⢤≖⋍⊗∐⊒↮∜⣭⇌⇭⣒≼≴∶≵⢭⋰⡦⇏∳⇄∍⋧⋐⣉⢊∝∠⠸⠯⋋≷⣑∮≜⡚⠕⊎∎⡐⣶⋇⊂⡘⢘⡵∟⋹∿⣜⣽⢱∞⊸⣸⢪↢⣖∹⇱⇳⡫≍↲⣴≳⊋⠩⋣⣰≈≾⢽≪∫⊘∈⋶⠒≘∖∪⊺⊏⠼⢼⠐⢮⊪⊕⊿⠬⇈⠚↷≻↾≆⠄⋂↚⇙⇁⠇⊓⢎⣲⡒⠓⣻≞⣈∬⊨⋔⇠↣⢹⣍∁⠋↠⡇⊁⡅↗⣣∾≂⠴⋭⠖⡥∆⇴⊄≐⊈⣐⋑⡂⊭≝∃⠗∛⇿⊡⡮⢿∣⡢↬≏⋒⢀∥⇦⠃⣔⇒⊥⇽⊚⢌⠿≥⋡↳↛⡀⋢⣅⣵≃↑≲⇆∧⡝⊧≓⢢∡≑⋸⢲↰⢳⣧⡭≹≬⊼⡙⊠⠤⡈⇟≎↸⣫∏⡏⢛⢑⣷⇯⢃∻∭⡔⊅⢨⇝≒⊶⠉⡾⇉⡛↼∵⋿⇻⋵⇂∩∼⡋⡽⡶↘⡨⊉⢞⊟≡⢈≰⇾≤⇵≙≊⣤⠈⋩↖⋴⇡↹⠮⠦⇢∰⠵⣁≣⡁⠜⋦⋪√⢥↿⣌⇃↴⊯≫⢾⇔⡷⇊⣠⋽⇞⣞∅⠰⋘≁⇸⊾⊫⢏↽⢴⋨⋱⠣⡯⣿∊⣩⡠⋖∯⊹⠟⠺⠞⡓⡕⇕⢸⋬⊊⣇⇧↜⇹⣙⢰⠥⊮∺↧⢋⋙⣟⋼⊣⠹⣹⡻⢫↞⣄⡗⡣⣨⇤⊛⡤↦⢵↝⡱⠽⠶⇰⢉⇷⢡↪⊱⋳↔⡪⊀⋆⣘⇶⢠⣡⊽⠊⇓∽⡞⊑⊐⇇⠱≕⣀↫⢩⢦⣢⡺↭⣪∂∢⠷⣊∗⋉⠳⇺⣂⢁⋯⡡⢣⠙⇬⠡⋗⠭≧⢜⣚⡳⋫⇚⋃⢗⋮⇲∨⠆⢒⠁⋚⋞⣬≢⡧≀⋓⢇≯⡿⋜⢂⠑⋁⋈≉⡩⠍⊞⊇≽⊳⢍⡟≨⇪⇍↥⇅⠝↵∑⡸⢕∲≅⊬⠠⠪≦⡊←↕⣳⋌⊦≠⋲⠲⊝⋎⊩⇜⠨⡹⣓⊵⠧⇣⊃∱⡲⋏↓⢷⠫∉⠂≌⢯⣏⠘≶⢄≟↶⋷≸⇎⡴⣾⣛⇘⇀⢔⡉⡬⡼⊤⢆⡄⢐⠾∋→⢧⇥∀⡜⡍≿⢙⇐⡌⇼⣼≮⋺⣱↙∘⊰≗⣆↯⣕⠔≄⊻⋛⡰⠏∓⠻↟≱⋀∷⢝∴⣥≋↤⋝↱∇⡑⣦⢖⢚⣯⋄⊆⡎⠎⢓≚⋊≇≛↺∌⋤−∙⠛⊲⊢∸⣗⋟⇗⋻%');

        self::assertEquals('18446744073709551615', $tinyId->decode($tinyId->encode('18446744073709551615')));
    }

    public function failuresProvider()
    {
        return [
            ['a', 'dictionary too short'],
            ['aa', 'dictionary contains duplicated characters'],
        ];
    }

    /**
     * @test
     * @dataProvider failuresProvider
     */
    public function failuresOnInvalidString($invalidString, $expectedMessage)
    {
        try {
            new TinyID($invalidString);
        } catch (\InvalidArgumentException $e) {
            self::assertEquals($expectedMessage, $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function failuresOnEncodingWithNegativeNumber()
    {
        try {
            (new TinyID('ab'))->encode(-1);
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('cannot encode negative number', $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function failuresOnDecodingWithCharacter()
    {
        try {
            (new TinyID('ab'))->decode('x');
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('cannot decode string with characters not in dictionary', $e->getMessage());
        }
    }
    
    public function dictionaryWithRepeatedSymbols()
    {
        $tinyId = new TinyID('abbc');
        self::assertEquals('c', $tinyId->encode('2'));
        self::assertEquals('2', $tinyId->encode('c'));
    }
}
