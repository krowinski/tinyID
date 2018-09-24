<?php

use TinyID\TinyID;

include __DIR__ . '/../vendor/autoload.php';

// dictionary must consist of at least two UNIQUE unicode characters.
$tinyId = new TinyID('2BjLhRduC6Tb8Q5cEk9oxnFaWUDpOlGAgwYzNre7tI4yqPvXm0KSV1fJs3ZiHM');

var_dump($tinyId->encode('48888851145')); // 1FN7Ab
var_dump($tinyId->decode('1FN7Ab')); // 48888851145

var_dump((new TinyID('0123456789ABCDEFGH'))->encode(48888851145)); // '47F709HFF'

var_dump((new TinyID('😀😁😂😃😄😅😆😇😈😉😊😋😌😍😎😏😐😑😒😓😔😕😖😗😘😙😚😛😜😝😞😟😠😡😢😣😤😥😦😧😨😩😪😫😬😭😮😯😰😱😲😳😴😵😶😷😸😹😺😻😼😽😾😿'))->encode(48888851145)); // '😭😢😀😊😫😉'
