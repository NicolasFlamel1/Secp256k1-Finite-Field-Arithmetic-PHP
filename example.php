<?php


// Enforce strict types
declare(strict_types=1);


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
