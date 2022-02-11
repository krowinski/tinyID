<?php

declare(strict_types=1);

namespace TinyID\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TinyID\TinyID;

class TinyIDTest extends TestCase
{
    public function testShortestKeyPossible(): void
    {
        $tinyId = new TinyID('ab');

        self::assertEquals('a', $tinyId->encode('0'));
        self::assertEquals('0', $tinyId->decode('a'));

        self::assertEquals('b', $tinyId->encode('1'));
        self::assertEquals('1', $tinyId->decode('b'));

        self::assertEquals('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', $tinyId->encode('18446744073709551615'));
        self::assertEquals('18446744073709551615', $tinyId->decode('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'));
    }

    public function testAccentSensitive(): void
    {
        $tinyId = new TinyID('ąä');

        self::assertEquals('äą', $tinyId->encode('2'));
        self::assertEquals('2', $tinyId->decode('äą'));
    }

    public function testCaseSensitive(): void
    {
        $tinyId = new TinyID('Aa');

        self::assertEquals('aA', $tinyId->encode('2'));
        self::assertEquals('2', $tinyId->decode('aA'));
    }

    public function testAlphanumericKey(): void
    {
        $tinyId = new TinyID('FujSBZHkPMincNQr6pq0mgxw2tXAsyb8DWV534EC1RUIlYoGOJhed9afKT7vzL');

        self::assertEquals('gzUp3uHipVr', $tinyId->encode('18446744073709551615'));
        self::assertEquals('18446744073709551615', $tinyId->decode('gzUp3uHipVr'));
    }

    public function testVeryLongUnicodeKey(): void
    {
        $tinyId
            = new TinyID(
            '⊷⇑≩≔⊴⊖⢻⢬⇖⊙⣮≺⇋↨⣺∄⇫⊌⊍⢶∦⠢⋠⊜⋅⋾⊔⠅⣎⋥⠌⣋⢟⋕⇮∔↻⣃⢅≭⡆∕↩⇨⢺⇩∤⣝⇛↡⡖⡃⢤≖⋍⊗∐⊒↮∜⣭⇌⇭⣒≼≴∶≵⢭⋰⡦⇏∳⇄∍⋧⋐⣉⢊∝∠⠸⠯⋋≷⣑∮≜⡚⠕⊎∎⡐⣶⋇⊂⡘⢘⡵∟⋹∿⣜⣽⢱∞⊸⣸⢪↢⣖∹⇱⇳⡫≍↲⣴≳⊋⠩⋣⣰≈≾⢽≪∫⊘∈⋶⠒≘∖∪⊺⊏⠼⢼⠐⢮⊪⊕⊿⠬⇈⠚↷≻↾≆⠄⋂↚⇙⇁⠇⊓⢎⣲⡒⠓⣻≞⣈∬⊨⋔⇠↣⢹⣍∁⠋↠⡇⊁⡅↗⣣∾≂⠴⋭⠖⡥∆⇴⊄≐⊈⣐⋑⡂⊭≝∃⠗∛⇿⊡⡮⢿∣⡢↬≏⋒⢀∥⇦⠃⣔⇒⊥⇽⊚⢌⠿≥⋡↳↛⡀⋢⣅⣵≃↑≲⇆∧⡝⊧≓⢢∡≑⋸⢲↰⢳⣧⡭≹≬⊼⡙⊠⠤⡈⇟≎↸⣫∏⡏⢛⢑⣷⇯⢃∻∭⡔⊅⢨⇝≒⊶⠉⡾⇉⡛↼∵⋿⇻⋵⇂∩∼⡋⡽⡶↘⡨⊉⢞⊟≡⢈≰⇾≤⇵≙≊⣤⠈⋩↖⋴⇡↹⠮⠦⇢∰⠵⣁≣⡁⠜⋦⋪√⢥↿⣌⇃↴⊯≫⢾⇔⡷⇊⣠⋽⇞⣞∅⠰⋘≁⇸⊾⊫⢏↽⢴⋨⋱⠣⡯⣿∊⣩⡠⋖∯⊹⠟⠺⠞⡓⡕⇕⢸⋬⊊⣇⇧↜⇹⣙⢰⠥⊮∺↧⢋⋙⣟⋼⊣⠹⣹⡻⢫↞⣄⡗⡣⣨⇤⊛⡤↦⢵↝⡱⠽⠶⇰⢉⇷⢡↪⊱⋳↔⡪⊀⋆⣘⇶⢠⣡⊽⠊⇓∽⡞⊑⊐⇇⠱≕⣀↫⢩⢦⣢⡺↭⣪∂∢⠷⣊∗⋉⠳⇺⣂⢁⋯⡡⢣⠙⇬⠡⋗⠭≧⢜⣚⡳⋫⇚⋃⢗⋮⇲∨⠆⢒⠁⋚⋞⣬≢⡧≀⋓⢇≯⡿⋜⢂⠑⋁⋈≉⡩⠍⊞⊇≽⊳⢍⡟≨⇪⇍↥⇅⠝↵∑⡸⢕∲≅⊬⠠⠪≦⡊←↕⣳⋌⊦≠⋲⠲⊝⋎⊩⇜⠨⡹⣓⊵⠧⇣⊃∱⡲⋏↓⢷⠫∉⠂≌⢯⣏⠘≶⢄≟↶⋷≸⇎⡴⣾⣛⇘⇀⢔⡉⡬⡼⊤⢆⡄⢐⠾∋→⢧⇥∀⡜⡍≿⢙⇐⡌⇼⣼≮⋺⣱↙∘⊰≗⣆↯⣕⠔≄⊻⋛⡰⠏∓⠻↟≱⋀∷⢝∴⣥≋↤⋝↱∇⡑⣦⢖⢚⣯⋄⊆⡎⠎⢓≚⋊≇≛↺∌⋤−∙⠛⊲⊢∸⣗⋟⇗⋻%'
        );

        self::assertEquals('18446744073709551615', $tinyId->decode($tinyId->encode('18446744073709551615')));
    }

    public function failuresProvider(): array
    {
        return [
            ['a', 'dictionary too short'],
            ['aa', 'dictionary contains duplicated characters'],
        ];
    }

    /**
     * @dataProvider failuresProvider
     * @param string $invalidString
     * @param string $expectedMessage
     */
    public function testFailuresOnInvalidString(string $invalidString, string $expectedMessage): void
    {
        try {
            new TinyID($invalidString);
        } catch (InvalidArgumentException $e) {
            self::assertEquals($expectedMessage, $e->getMessage());
        }
    }

    public function testFailuresOnEncodingWithNegativeNumber(): void
    {
        try {
            (new TinyID('ab'))->encode('-1');
        } catch (InvalidArgumentException $e) {
            self::assertEquals('cannot encode negative number', $e->getMessage());
        }
    }

    public function testFailuresOnDecodingWithCharacter(): void
    {
        try {
            (new TinyID('ab'))->decode('x');
        } catch (InvalidArgumentException $e) {
            self::assertEquals('cannot decode string with characters not in dictionary', $e->getMessage());
        }
    }
}
