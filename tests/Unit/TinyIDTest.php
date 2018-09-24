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

    /**
     * @test
     */
    public function failures()
    {
        try {
            new TinyID('a');
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('dictionary too short', $e->getMessage());
        }

        try {
            new TinyID('aa');
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('dictionary contains duplicated characters', $e->getMessage());
        }

        try {
            (new TinyID('ab'))->encode(-1);
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('cannot encode negative number', $e->getMessage());
        }

        try {
            (new TinyID('ab'))->decode('x');
        } catch (\InvalidArgumentException $e) {
            self::assertEquals('cannot decode string with characters not in dictionary', $e->getMessage());
        }
    }
}
