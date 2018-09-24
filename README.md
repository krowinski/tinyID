# Shorten and obfuscate IDs

[![Build Status](https://travis-ci.org/krowinski/tinyID.svg?branch=master)](https://travis-ci.org/krowinski/tinyID)

## SYNOPSIS

```php
    use TinyID\TinyID;
    
    include __DIR__ . '/../vendor/autoload.php';
    
    // dictionary must consist of at least two UNIQUE unicode characters.
    $tinyId = new TinyID('2BjLhRduC6Tb8Q5cEk9oxnFaWUDpOlGAgwYzNre7tI4yqPvXm0KSV1fJs3ZiHM');
    
    var_dump($tinyId->encode('48888851145')); // will print
    var_dump($tinyId->decode('1FN7Ab')); // will print 48888851145
```

## DESCRIPTION

Using real IDs in various places - such as GET links or API payload - is generally a bad idea:

* It may reveal some sensitive informations about your business, such as growth rate or amount of customers.
* If someone finds unprotected resource link, where you forgot to check if passed resource ID really belongs to currently logged-in user, he will be able to steal all of your data really fast just by incrementing ID in links.
* Big numbers may cause overflows in places where length is limited, such as SMS messages.

With the help of this module you can shorten and obfuscate your IDs at the same time.

## METHODS

### new TidyID('qwerty')

Key must consist of at least two ***unique*** unicode characters.

The longer the dictionary - the shorter encoded ID.

Encoded ID will be made exclusively out of characters from the key.
This very useful property allows to adapt your encoding to the environment.
For example in SMS messages you may restrict key to US ASCII to avoid available length reduction caused by conversion to GSM 03.38 charset.
Or if you want to use such ID as file/directory name in case insensitive filesystem you may want to use only lowercase letters in the key.

### encode(123)

Encode positive integer into a string.

Note that leading `0`s are not preserved, `encode(123)` is the same as `encode(00123)`.

Used algorithm is a base to the length of the key conversion that maps to distinct permutation of characters.
Do not consider it a strong encryption, but if you have secret and long and well shuffled key it is almost impossible to reverse-engineer real ID.

### decode('rer')

Decode string back into a positive integer.

## TRICKS

If you provide sequential characters in key you can convert your numbers to some weird numeric systems, for example base18:

```php
    var_dump((new TinyID('0123456789ABCDEFGH'))->encode(48888851145)); // '47F709HFF'
```

Or you can go wild just for the fun of it.

```php
    var_dump((new TinyID('😀😁😂😃😄😅😆😇😈😉😊😋😌😍😎😏😐😑😒😓😔😕😖😗😘😙😚😛😜😝😞😟😠😡😢😣😤😥😦😧😨😩😪😫😬😭😮😯😰😱😲😳😴😵😶😷😸😹😺😻😼😽😾😿'))->encode(48888851145)); // '😭😢😀😊😫😉'
```

It's based on great work of *bbkr* and his project [https://github.com/bbkr/TinyID](https://github.com/bbkr/TinyID)

All examples are in example dir.