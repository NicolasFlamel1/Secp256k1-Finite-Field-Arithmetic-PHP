# Secp256k1 Finite Field Arithmetic PHP

### Description
Secp256k1's finite field arithmetic written in pure PHP without using any extensions. This code attempts to be constant-time, but provides no guarantees of this since, as far as I know, PHP itself doesn't require any part of its implementations to be constant-time.

This was created to demonstrate that pure PHP isn't fast enough to perform elliptic curve cryptography in an acceptable amount of time. The large number arithmetic used in elliptic curve cryptography could be implemented in a faster way by using the [BC Math](https://www.php.net/manual/en/book.bc.php) or [GMP](https://www.php.net/manual/en/book.gmp.php) PHP extensions, however neither of those extensions provides constant-time operations so any implementation that uses them will be vulnerable to timing side-channel attacks. So the only fast enough, cryptographically safe way to use elliptic curve cryptography in PHP for a curve that's not already supported by any of [PHP's cryptography extensions](https://www.php.net/manual/en/refs.crypto.php) is to create your own PHP extension or use [PHP's foreign function interface](https://www.php.net/manual/en/book.ffi.php). You can find an example of how I used PHP's foreign function interface to use an secp256k1 library written in C in PHP [here](https://github.com/NicolasFlamel1/Secp256k1-zkp-PHP-Library).

### Usage
The following example shows how to use all the functions that this code provides.
```
<?php

// Include dependencies
require_once __DIR__ . "/FieldElement.php";

// Create field elements
$x = new FieldElement("\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFE\xFF\xFF\xFC\x2E");
$y = new FieldElement("\x01\x23\x45\x67\x89\xAB\xCD\xEF\x01\x23\x45\x67\x89\xAB\xCD\xEF\x01\x23\x45\x67\x89\xAB\xCD\xEF\x01\x23\x45\x67\x89\xAB\xCD\xEF");

// Get field element's value
echo "x is " . bin2hex($x->getValue()) . PHP_EOL;
echo "y is " . bin2hex($y->getValue()) . PHP_EOL;

// Clone field element
$temp = $x->clone();
echo "temp is " . bin2hex($temp->getValue()) . PHP_EOL;

// Copy field element
$temp->copy($y);
echo "temp is " . bin2hex($temp->getValue()) . PHP_EOL;

// Check if field element is zero
if($x->isZero() === TRUE) {
	echo "x is zero" . PHP_EOL;
}

// Check if field element isn't zero
if($x->isNotZero() === TRUE) {
	echo "x is not zero" . PHP_EOL;
}

// Check if field elements are equal
if($x->isEqualTo($y) === TRUE) {
	echo "x is equal to y" . PHP_EOL;
}

// Check if field elements are not equal
if($x->isNotEqualTo($y) === TRUE) {
	echo "x is not equal to y" . PHP_EOL;
}

// Add field elements
$x->add($y);
echo "x + y is " . bin2hex($x->getValue()) . PHP_EOL;

// Add integer to field element
$x->addInteger(100);
echo "x + y + 100 is " . bin2hex($x->getValue()) . PHP_EOL;

// Subtract field elements
$x->subtract($y);
echo "x + y + 100 - y is " . bin2hex($x->getValue()) . PHP_EOL;

// Subtract integer from field element
$x->subtractInteger(100);
echo "x + y + 100 - y - 100 is " . bin2hex($x->getValue()) . PHP_EOL;

// Multiply field elements
$x->multiply($y);
echo "x * y is " . bin2hex($x->getValue()) . PHP_EOL;

// Multiply field element by integer
$x->multiplyInteger(100);
echo "x * y * 100 is " . bin2hex($x->getValue()) . PHP_EOL;

// Get inverse of field element
$x->inverse();
echo "(x * y * 100)^-1 is " . bin2hex($x->getValue()) . PHP_EOL;

?>
```
