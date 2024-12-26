<?php


// Enforce strict types
declare(strict_types=1);


// Check if PHP version isn't at least 64 bit
if(PHP_INT_SIZE < 8) {

	// Throw error
	throw new \Exception("Not compatible with " . (PHP_INT_SIZE * 8) . " bit versions of PHP");
}


// Classes

// Field element class
final class FieldElement {

	// Limbs
	private array $limbs;
	
	// Buffer
	private array $buffer;
	
	// Constructor
	public function __construct(?string $value = NULL) {
	
		// Create limbs
		$this->limbs = array_fill(0, 8, 0);
		
		// Create buffer
		$this->buffer = array_fill(0, 16, 0);
		
		// Check if value exists
		if($value !== NULL) {
		
			// Check if value isn't the correct size
			if(strlen($value) !== 32) {
			
				// Throw error
				throw new \Exception("Value is invalid");
			}
			
			// Set limbs from value
			$this->limbs[0] = (ord($value[28]) << 24) | (ord($value[29]) << 16) | (ord($value[30]) << 8) | ord($value[31]);
			$this->limbs[1] = (ord($value[24]) << 24) | (ord($value[25]) << 16) | (ord($value[26]) << 8) | ord($value[27]);
			$this->limbs[2] = (ord($value[20]) << 24) | (ord($value[21]) << 16) | (ord($value[22]) << 8) | ord($value[23]);
			$this->limbs[3] = (ord($value[16]) << 24) | (ord($value[17]) << 16) | (ord($value[18]) << 8) | ord($value[19]);
			$this->limbs[4] = (ord($value[12]) << 24) | (ord($value[13]) << 16) | (ord($value[14]) << 8) | ord($value[15]);
			$this->limbs[5] = (ord($value[8]) << 24) | (ord($value[9]) << 16) | (ord($value[10]) << 8) | ord($value[11]);
			$this->limbs[6] = (ord($value[4]) << 24) | (ord($value[5]) << 16) | (ord($value[6]) << 8) | ord($value[7]);
			$this->limbs[7] = (ord($value[0]) << 24) | (ord($value[1]) << 16) | (ord($value[2]) << 8) | ord($value[3]);
			
			// Check if limbs is greater than or equal to the prime
			if((((($this->limbs[0] - 0xFFFFFC2F) >> 32) & (($this->limbs[1] - 0xFFFFFFFF) >> 32)) | (($this->limbs[1] ^ 0xFFFFFFFE) & 0xFFFFFFFE) | ($this->limbs[2] ^ 0xFFFFFFFF) | ($this->limbs[3] ^ 0xFFFFFFFF) | ($this->limbs[4] ^ 0xFFFFFFFF) | ($this->limbs[5] ^ 0xFFFFFFFF) | ($this->limbs[6] ^ 0xFFFFFFFF) | ($this->limbs[7] ^ 0xFFFFFFFF)) === 0) {
			
				// Set limbs to zero
				$this->limbs[0] = 0;
				$this->limbs[1] = 0;
				$this->limbs[2] = 0;
				$this->limbs[3] = 0;
				$this->limbs[4] = 0;
				$this->limbs[5] = 0;
				$this->limbs[6] = 0;
				$this->limbs[7] = 0;
				
				// Throw error
				throw new \Exception("Value is invalid");
			}
		}
	}
	
	// Destructor
	public function __destruct() {
	
		// Set limbs to zero
		$this->limbs[0] = 0;
		$this->limbs[1] = 0;
		$this->limbs[2] = 0;
		$this->limbs[3] = 0;
		$this->limbs[4] = 0;
		$this->limbs[5] = 0;
		$this->limbs[6] = 0;
		$this->limbs[7] = 0;
		
		// Set buffer to zero
		$this->buffer[0] = 0;
		$this->buffer[1] = 0;
		$this->buffer[2] = 0;
		$this->buffer[3] = 0;
		$this->buffer[4] = 0;
		$this->buffer[5] = 0;
		$this->buffer[6] = 0;
		$this->buffer[7] = 0;
		$this->buffer[8] = 0;
		$this->buffer[9] = 0;
		$this->buffer[10] = 0;
		$this->buffer[11] = 0;
		$this->buffer[12] = 0;
		$this->buffer[13] = 0;
		$this->buffer[14] = 0;
		$this->buffer[15] = 0;
	}
	
	// Get value
	public function getValue(): string {
	
		// Create value
		$value = str_repeat("\x00", 32);
		
		// Set value from limbs
		$value[0] = chr($this->limbs[7] >> 24);
		$value[1] = chr(($this->limbs[7] >> 16) & 0xFF);
		$value[2] = chr(($this->limbs[7] >> 8) & 0xFF);
		$value[3] = chr($this->limbs[7] & 0xFF);
		$value[4] = chr($this->limbs[6] >> 24);
		$value[5] = chr(($this->limbs[6] >> 16) & 0xFF);
		$value[6] = chr(($this->limbs[6] >> 8) & 0xFF);
		$value[7] = chr($this->limbs[6] & 0xFF);
		$value[8] = chr($this->limbs[5] >> 24);
		$value[9] = chr(($this->limbs[5] >> 16) & 0xFF);
		$value[10] = chr(($this->limbs[5] >> 8) & 0xFF);
		$value[11] = chr($this->limbs[5] & 0xFF);
		$value[12] = chr($this->limbs[4] >> 24);
		$value[13] = chr(($this->limbs[4] >> 16) & 0xFF);
		$value[14] = chr(($this->limbs[4] >> 8) & 0xFF);
		$value[15] = chr($this->limbs[4] & 0xFF);
		$value[16] = chr($this->limbs[3] >> 24);
		$value[17] = chr(($this->limbs[3] >> 16) & 0xFF);
		$value[18] = chr(($this->limbs[3] >> 8) & 0xFF);
		$value[19] = chr($this->limbs[3] & 0xFF);
		$value[20] = chr($this->limbs[2] >> 24);
		$value[21] = chr(($this->limbs[2] >> 16) & 0xFF);
		$value[22] = chr(($this->limbs[2] >> 8) & 0xFF);
		$value[23] = chr($this->limbs[2] & 0xFF);
		$value[24] = chr($this->limbs[1] >> 24);
		$value[25] = chr(($this->limbs[1] >> 16) & 0xFF);
		$value[26] = chr(($this->limbs[1] >> 8) & 0xFF);
		$value[27] = chr($this->limbs[1] & 0xFF);
		$value[28] = chr($this->limbs[0] >> 24);
		$value[29] = chr(($this->limbs[0] >> 16) & 0xFF);
		$value[30] = chr(($this->limbs[0] >> 8) & 0xFF);
		$value[31] = chr($this->limbs[0] & 0xFF);
		
		// Return value
		return $value;
	}
	
	// Clone
	public function clone(): FieldElement {
	
		// Create value
		$value = new FieldElement;
		
		// Set value's limbs to limbs
		$value->limbs[0] = $this->limbs[0];
		$value->limbs[1] = $this->limbs[1];
		$value->limbs[2] = $this->limbs[2];
		$value->limbs[3] = $this->limbs[3];
		$value->limbs[4] = $this->limbs[4];
		$value->limbs[5] = $this->limbs[5];
		$value->limbs[6] = $this->limbs[6];
		$value->limbs[7] = $this->limbs[7];
		
		// Return value
		return $value;
	}
	
	// Copy
	public function copy(FieldElement $value): void {
	
		// Set limbs to value's limbs
		$this->limbs[0] = $value->limbs[0];
		$this->limbs[1] = $value->limbs[1];
		$this->limbs[2] = $value->limbs[2];
		$this->limbs[3] = $value->limbs[3];
		$this->limbs[4] = $value->limbs[4];
		$this->limbs[5] = $value->limbs[5];
		$this->limbs[6] = $value->limbs[6];
		$this->limbs[7] = $value->limbs[7];
	}
	
	// Is zero
	public function isZero(): bool {
	
		// Return if all limbs are zero
		return ($this->limbs[0] | $this->limbs[1] | $this->limbs[2] | $this->limbs[3] | $this->limbs[4] | $this->limbs[5] | $this->limbs[6] | $this->limbs[7]) === 0;
	}
	
	// Is not zero
	public function isNotZero(): bool {
	
		// Return if a limb isn't zero
		return ($this->limbs[0] | $this->limbs[1] | $this->limbs[2] | $this->limbs[3] | $this->limbs[4] | $this->limbs[5] | $this->limbs[6] | $this->limbs[7]) !== 0;
	}
	
	// Is equal to
	public function isEqualTo(FieldElement $value): bool {
	
		// Return if all limbs are equal
		return (($this->limbs[0] ^ $value->limbs[0]) | ($this->limbs[1] ^ $value->limbs[1]) | ($this->limbs[2] ^ $value->limbs[2]) | ($this->limbs[3] ^ $value->limbs[3]) | ($this->limbs[4] ^ $value->limbs[4]) | ($this->limbs[5] ^ $value->limbs[5]) | ($this->limbs[6] ^ $value->limbs[6]) | ($this->limbs[7] ^ $value->limbs[7])) === 0;
	}
	
	// Is not equal to
	public function isNotEqualTo(FieldElement $value): bool {
	
		// Return if a limb isn't equal
		return (($this->limbs[0] ^ $value->limbs[0]) | ($this->limbs[1] ^ $value->limbs[1]) | ($this->limbs[2] ^ $value->limbs[2]) | ($this->limbs[3] ^ $value->limbs[3]) | ($this->limbs[4] ^ $value->limbs[4]) | ($this->limbs[5] ^ $value->limbs[5]) | ($this->limbs[6] ^ $value->limbs[6]) | ($this->limbs[7] ^ $value->limbs[7])) !== 0;
	}
	
	// Add
	public function add(FieldElement $value): void {
	
		// Add value's limbs to limbs
		$carry = $this->limbs[0] + $value->limbs[0];
		$this->limbs[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[1] + $value->limbs[1];
		$this->limbs[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[2] + $value->limbs[2];
		$this->limbs[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[3] + $value->limbs[3];
		$this->limbs[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[4] + $value->limbs[4];
		$this->limbs[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[5] + $value->limbs[5];
		$this->limbs[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[6] + $value->limbs[6];
		$this->limbs[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[7] + $value->limbs[7];
		$this->limbs[7] = $carry & 0xFFFFFFFF;
		
		// Subtract the prime from limbs if limbs is greater than or equal to the prime
		$lessThanPrimeMask = -(((-(($this->limbs[0] - 0xFFFFFC2F) >> 32) & (($this->limbs[1] - 0xFFFFFFFF) >> 32)) | (($this->limbs[1] ^ 0xFFFFFFFE) & 0xFFFFFFFE) | ($this->limbs[2] ^ 0xFFFFFFFF) | ($this->limbs[3] ^ 0xFFFFFFFF) | ($this->limbs[4] ^ 0xFFFFFFFF) | ($this->limbs[5] ^ 0xFFFFFFFF) | ($this->limbs[6] ^ 0xFFFFFFFF) | ($this->limbs[7] ^ 0xFFFFFFFF)) & (($carry >> 32) - 1)) >> 32;
		$greaterThanOrEqualToPrimeMask = ~$lessThanPrimeMask;
		$carry = 1 + $this->limbs[0] - 0xFFFFFC2F + 0xFFFFFFFF;
		$this->limbs[0] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[0] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[1] - 0xFFFFFFFE + 0xFFFFFFFF;
		$this->limbs[1] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[1] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[2] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[2] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[2] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[3] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[3] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[3] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[4] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[4] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[4] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[5] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[5] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[5] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[6] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[6] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[6] & $lessThanPrimeMask);
		$this->limbs[7] = (((($carry >> 32) + $this->limbs[7] - 0xFFFFFFFF + 0xFFFFFFFF) & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[7] & $lessThanPrimeMask);
	}
	
	// Add integer
	public function addInteger(int $value): void {
	
		// Check if value is invalid
		if($value < 0 || $value > 0x7FFFFFFF00000000) {
		
			// Throw error
			throw new \Exception("Value is invalid");
		}
		
		// Add value to limbs
		$carry = $this->limbs[0] + $value;
		$this->limbs[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[1];
		$this->limbs[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[2];
		$this->limbs[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[3];
		$this->limbs[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[4];
		$this->limbs[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[5];
		$this->limbs[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[6];
		$this->limbs[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[7];
		$this->limbs[7] = $carry & 0xFFFFFFFF;
		
		// Subtract the prime from limbs if limbs is greater than or equal to the prime
		$lessThanPrimeMask = -(((-(($this->limbs[0] - 0xFFFFFC2F) >> 32) & (($this->limbs[1] - 0xFFFFFFFF) >> 32)) | (($this->limbs[1] ^ 0xFFFFFFFE) & 0xFFFFFFFE) | ($this->limbs[2] ^ 0xFFFFFFFF) | ($this->limbs[3] ^ 0xFFFFFFFF) | ($this->limbs[4] ^ 0xFFFFFFFF) | ($this->limbs[5] ^ 0xFFFFFFFF) | ($this->limbs[6] ^ 0xFFFFFFFF) | ($this->limbs[7] ^ 0xFFFFFFFF)) & (($carry >> 32) - 1)) >> 32;
		$greaterThanOrEqualToPrimeMask = ~$lessThanPrimeMask;
		$carry = 1 + $this->limbs[0] - 0xFFFFFC2F + 0xFFFFFFFF;
		$this->limbs[0] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[0] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[1] - 0xFFFFFFFE + 0xFFFFFFFF;
		$this->limbs[1] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[1] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[2] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[2] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[2] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[3] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[3] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[3] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[4] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[4] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[4] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[5] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[5] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[5] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[6] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[6] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[6] & $lessThanPrimeMask);
		$this->limbs[7] = (((($carry >> 32) + $this->limbs[7] - 0xFFFFFFFF + 0xFFFFFFFF) & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[7] & $lessThanPrimeMask);
	}
	
	// Subtract
	public function subtract(FieldElement $value): void {
	
		// Subtract value's limbs from limbs
		$carry = 1 + $this->limbs[0] - $value->limbs[0] + 0xFFFFFFFF;
		$this->limbs[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[1] - $value->limbs[1] + 0xFFFFFFFF;
		$this->limbs[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[2] - $value->limbs[2] + 0xFFFFFFFF;
		$this->limbs[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[3] - $value->limbs[3] + 0xFFFFFFFF;
		$this->limbs[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[4] - $value->limbs[4] + 0xFFFFFFFF;
		$this->limbs[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[5] - $value->limbs[5] + 0xFFFFFFFF;
		$this->limbs[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[6] - $value->limbs[6] + 0xFFFFFFFF;
		$this->limbs[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[7] - $value->limbs[7] + 0xFFFFFFFF;
		$this->limbs[7] = $carry & 0xFFFFFFFF;
		
		// Add the prime to limbs if an underflow occurred
		$underflowDidntOccurMask = -($carry >> 32);
		$underflowOccurMask = ~$underflowDidntOccurMask;
		$carry = $this->limbs[0] + 0xFFFFFC2F;
		$this->limbs[0] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[0] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[1] + 0xFFFFFFFE;
		$this->limbs[1] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[1] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[2] + 0xFFFFFFFF;
		$this->limbs[2] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[2] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[3] + 0xFFFFFFFF;
		$this->limbs[3] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[3] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[4] + 0xFFFFFFFF;
		$this->limbs[4] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[4] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[5] + 0xFFFFFFFF;
		$this->limbs[5] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[5] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[6] + 0xFFFFFFFF;
		$this->limbs[6] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[6] & $underflowDidntOccurMask);
		$this->limbs[7] = (((($carry >> 32) + $this->limbs[7] + 0xFFFFFFFF) & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[7] & $underflowDidntOccurMask);
	}
	
	// Subtract integer
	public function subtractInteger(int $value): void {
	
		// Check if value is invalid
		if($value < 0 || $value > 0x100000000) {
		
			// Throw error
			throw new \Exception("Value is invalid");
		}
		
		// Subtract value from limbs
		$carry = 1 + $this->limbs[0] - $value + 0xFFFFFFFF;
		$this->limbs[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[1] + 0xFFFFFFFF;
		$this->limbs[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[2] + 0xFFFFFFFF;
		$this->limbs[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[3] + 0xFFFFFFFF;
		$this->limbs[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[4] + 0xFFFFFFFF;
		$this->limbs[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[5] + 0xFFFFFFFF;
		$this->limbs[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[6] + 0xFFFFFFFF;
		$this->limbs[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->limbs[7] + 0xFFFFFFFF;
		$this->limbs[7] = $carry & 0xFFFFFFFF;
		
		// Add the prime to limbs if an underflow occurred
		$underflowDidntOccurMask = -($carry >> 32);
		$underflowOccurMask = ~$underflowDidntOccurMask;
		$carry = $this->limbs[0] + 0xFFFFFC2F;
		$this->limbs[0] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[0] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[1] + 0xFFFFFFFE;
		$this->limbs[1] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[1] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[2] + 0xFFFFFFFF;
		$this->limbs[2] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[2] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[3] + 0xFFFFFFFF;
		$this->limbs[3] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[3] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[4] + 0xFFFFFFFF;
		$this->limbs[4] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[4] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[5] + 0xFFFFFFFF;
		$this->limbs[5] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[5] & $underflowDidntOccurMask);
		$carry = ($carry >> 32) + $this->limbs[6] + 0xFFFFFFFF;
		$this->limbs[6] = (($carry & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[6] & $underflowDidntOccurMask);
		$this->limbs[7] = (((($carry >> 32) + $this->limbs[7] + 0xFFFFFFFF) & 0xFFFFFFFF) & $underflowOccurMask) | ($this->limbs[7] & $underflowDidntOccurMask);
	}
	
	// Multiply
	public function multiply(FieldElement $value): void {
	
		// Set buffer to the product of value's limbs and limbs
		$limbLowBits = $this->limbs[0] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[0] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF);
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$this->buffer[8] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[1] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[1] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[1];
		$this->buffer[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[2];
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$this->buffer[9] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[2] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[2] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[2];
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$this->buffer[10] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[3] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[3] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[10];
		$this->buffer[10] = $carry & 0xFFFFFFFF;
		$this->buffer[11] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[4] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[4] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[10];
		$this->buffer[10] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[11];
		$this->buffer[11] = $carry & 0xFFFFFFFF;
		$this->buffer[12] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[5] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[5] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[10];
		$this->buffer[10] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[11];
		$this->buffer[11] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[12];
		$this->buffer[12] = $carry & 0xFFFFFFFF;
		$this->buffer[13] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[6] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[6] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[10];
		$this->buffer[10] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[11];
		$this->buffer[11] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[12];
		$this->buffer[12] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[13];
		$this->buffer[13] = $carry & 0xFFFFFFFF;
		$this->buffer[14] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$limbLowBits = $this->limbs[7] & 0x7FFFFFFF;
		$limbHighBits = $this->limbs[7] & 0x80000000;
		$productPartOne = $limbLowBits * $value->limbs[0];
		$productPartTwo = $limbHighBits * $value->limbs[0];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[1];
		$productPartTwo = $limbHighBits * $value->limbs[1];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[8];
		$this->buffer[8] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[2];
		$productPartTwo = $limbHighBits * $value->limbs[2];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[9];
		$this->buffer[9] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[3];
		$productPartTwo = $limbHighBits * $value->limbs[3];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[10];
		$this->buffer[10] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[4];
		$productPartTwo = $limbHighBits * $value->limbs[4];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[11];
		$this->buffer[11] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[5];
		$productPartTwo = $limbHighBits * $value->limbs[5];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[12];
		$this->buffer[12] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[6];
		$productPartTwo = $limbHighBits * $value->limbs[6];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[13];
		$this->buffer[13] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = $limbLowBits * $value->limbs[7];
		$productPartTwo = $limbHighBits * $value->limbs[7];
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += ($productWithoutHighestByte & 0x00FFFFFFFFFFFFFF) + $this->buffer[14];
		$this->buffer[14] = $carry & 0xFFFFFFFF;
		$this->buffer[15] = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		
		// Reduce buffer by the prime
		$carryOne = $this->buffer[8] * 0x5555569B + $this->buffer[0];
		$this->buffer[0] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[9] * 0x5555569B + $this->buffer[1];
		$this->buffer[1] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[10] * 0x5555569B + $this->buffer[2];
		$this->buffer[2] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[11] * 0x5555569B + $this->buffer[3];
		$this->buffer[3] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[12] * 0x5555569B + $this->buffer[4];
		$this->buffer[4] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[13] * 0x5555569B + $this->buffer[5];
		$this->buffer[5] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[14] * 0x5555569B + $this->buffer[6];
		$this->buffer[6] = $carryOne & 0xFFFFFFFF;
		$carryOne = ($carryOne >> 32) + $this->buffer[15] * 0x5555569B + $this->buffer[7];
		$this->buffer[7] = $carryOne & 0xFFFFFFFF;
		$carryTwo = $this->buffer[8] * 0x5555569B + $this->buffer[0];
		$this->buffer[0] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[9] * 0x5555569B + $this->buffer[1];
		$this->buffer[1] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[10] * 0x5555569B + $this->buffer[2];
		$this->buffer[2] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[11] * 0x5555569B + $this->buffer[3];
		$this->buffer[3] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[12] * 0x5555569B + $this->buffer[4];
		$this->buffer[4] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[13] * 0x5555569B + $this->buffer[5];
		$this->buffer[5] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[14] * 0x5555569B + $this->buffer[6];
		$this->buffer[6] = $carryTwo & 0xFFFFFFFF;
		$carryTwo = ($carryTwo >> 32) + $this->buffer[15] * 0x5555569B + $this->buffer[7];
		$this->buffer[7] = $carryTwo & 0xFFFFFFFF;
		$carryThree = $this->buffer[8] * 0x5555569B + $this->buffer[0];
		$this->buffer[0] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[9] * 0x5555569B + $this->buffer[1];
		$this->buffer[1] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[10] * 0x5555569B + $this->buffer[2];
		$this->buffer[2] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[11] * 0x5555569B + $this->buffer[3];
		$this->buffer[3] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[12] * 0x5555569B + $this->buffer[4];
		$this->buffer[4] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[13] * 0x5555569B + $this->buffer[5];
		$this->buffer[5] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[14] * 0x5555569B + $this->buffer[6];
		$this->buffer[6] = $carryThree & 0xFFFFFFFF;
		$carryThree = ($carryThree >> 32) + $this->buffer[15] * 0x5555569B + $this->buffer[7];
		$this->buffer[7] = $carryThree & 0xFFFFFFFF;
		$oneThird = (($carryOne >> 32) + ($carryTwo >> 32) + ($carryThree >> 32)) * 0x5555569B;
		$carry = $this->buffer[0] + $oneThird;
		$this->buffer[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[1];
		$this->buffer[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[2];
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carrySum = $carry >> 32;
		$carry = $this->buffer[0] + $oneThird;
		$this->buffer[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[1];
		$this->buffer[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[2];
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carrySum += $carry >> 32;
		$carry = $this->buffer[0] + $oneThird;
		$this->buffer[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[1];
		$this->buffer[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[2];
		$this->buffer[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[3];
		$this->buffer[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[4];
		$this->buffer[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[5];
		$this->buffer[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[6];
		$this->buffer[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + $this->buffer[7];
		$this->buffer[7] = $carry & 0xFFFFFFFF;
		$carrySum += $carry >> 32;
		$lessThanPrimeMask = -(((-(($this->buffer[0] - 0xFFFFFC2F) >> 32) & (($this->buffer[1] - 0xFFFFFFFF) >> 32)) | (($this->buffer[1] ^ 0xFFFFFFFE) & 0xFFFFFFFE) | ($this->buffer[2] ^ 0xFFFFFFFF) | ($this->buffer[3] ^ 0xFFFFFFFF) | ($this->buffer[4] ^ 0xFFFFFFFF) | ($this->buffer[5] ^ 0xFFFFFFFF) | ($this->buffer[6] ^ 0xFFFFFFFF) | ($this->buffer[7] ^ 0xFFFFFFFF)) & ($carrySum - 1)) >> 32;
		$greaterThanOrEqualToPrimeMask = ~$lessThanPrimeMask;
		$carry = 1 + $this->buffer[0] - 0xFFFFFC2F + 0xFFFFFFFF;
		$this->buffer[0] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[0] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[1] - 0xFFFFFFFE + 0xFFFFFFFF;
		$this->buffer[1] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[1] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[2] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->buffer[2] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[2] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[3] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->buffer[3] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[3] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[4] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->buffer[4] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[4] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[5] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->buffer[5] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[5] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->buffer[6] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->buffer[6] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[6] & $lessThanPrimeMask);
		$this->buffer[7] = (((($carry >> 32) + $this->buffer[7] - 0xFFFFFFFF + 0xFFFFFFFF) & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->buffer[7] & $lessThanPrimeMask);
		
		// Get limbs from buffer
		$this->limbs[0] = $this->buffer[0];
		$this->limbs[1] = $this->buffer[1];
		$this->limbs[2] = $this->buffer[2];
		$this->limbs[3] = $this->buffer[3];
		$this->limbs[4] = $this->buffer[4];
		$this->limbs[5] = $this->buffer[5];
		$this->limbs[6] = $this->buffer[6];
		$this->limbs[7] = $this->buffer[7];
	}
	
	// Multiply integer
	public function multiplyInteger(int $value): void {
	
		// Check if value is invalid
		if($value < 0 || $value > 0xFFFFFFFF) {
		
			// Throw error
			throw new \Exception("Value is invalid");
		}
		
		// Multiply limbs by value
		$productPartOne = ($this->limbs[0] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[0] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry = $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[0] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[1] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[1] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[1] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[2] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[2] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[2] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[3] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[3] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[3] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[4] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[4] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[4] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[5] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[5] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[5] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[6] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[6] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[6] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		$productPartOne = ($this->limbs[7] & 0x7FFFFFFF) * $value;
		$productPartTwo = ($this->limbs[7] & 0x80000000) * $value;
		$productWithoutHighestByte = ($productPartOne & 0x00FFFFFFFFFFFFFF) + ($productPartTwo & 0x00FFFFFFFFFFFFFF);
		$carry += $productWithoutHighestByte & 0x00FFFFFFFFFFFFFF;
		$this->limbs[7] = $carry & 0xFFFFFFFF;
		$carry = ($carry >> 32) + ((($productPartOne >> 56) + ($productPartTwo >> 56) + ($productWithoutHighestByte >> 56)) << 24);
		
		// Reduce limbs by the prime
		$carryPart = ($carry << 31) + $this->limbs[0];
		$this->limbs[0] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[1];
		$this->limbs[1] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[2];
		$this->limbs[2] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[3];
		$this->limbs[3] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[4];
		$this->limbs[4] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[5];
		$this->limbs[5] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[6];
		$this->limbs[6] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[7];
		$this->limbs[7] = $carryPart & 0xFFFFFFFF;
		$carrySum = $carryPart >> 32;
		$carryPart = ($carry << 31) + $this->limbs[0];
		$this->limbs[0] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[1];
		$this->limbs[1] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[2];
		$this->limbs[2] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[3];
		$this->limbs[3] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[4];
		$this->limbs[4] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[5];
		$this->limbs[5] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[6];
		$this->limbs[6] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[7];
		$this->limbs[7] = $carryPart & 0xFFFFFFFF;
		$carrySum += $carryPart >> 32;
		$carryPart = $carry * 0x000003D1 + $this->limbs[0];
		$this->limbs[0] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[1];
		$this->limbs[1] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[2];
		$this->limbs[2] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[3];
		$this->limbs[3] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[4];
		$this->limbs[4] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[5];
		$this->limbs[5] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[6];
		$this->limbs[6] = $carryPart & 0xFFFFFFFF;
		$carryPart = ($carryPart >> 32) + $this->limbs[7];
		$this->limbs[7] = $carryPart & 0xFFFFFFFF;
		$carrySum += $carryPart >> 32;
		$lessThanPrimeMask = -(((-(($this->limbs[0] - 0xFFFFFC2F) >> 32) & (($this->limbs[1] - 0xFFFFFFFF) >> 32)) | (($this->limbs[1] ^ 0xFFFFFFFE) & 0xFFFFFFFE) | ($this->limbs[2] ^ 0xFFFFFFFF) | ($this->limbs[3] ^ 0xFFFFFFFF) | ($this->limbs[4] ^ 0xFFFFFFFF) | ($this->limbs[5] ^ 0xFFFFFFFF) | ($this->limbs[6] ^ 0xFFFFFFFF) | ($this->limbs[7] ^ 0xFFFFFFFF)) & ($carrySum - 1)) >> 32;
		$greaterThanOrEqualToPrimeMask = ~$lessThanPrimeMask;
		$carry = 1 + $this->limbs[0] - 0xFFFFFC2F + 0xFFFFFFFF;
		$this->limbs[0] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[0] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[1] - 0xFFFFFFFE + 0xFFFFFFFF;
		$this->limbs[1] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[1] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[2] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[2] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[2] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[3] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[3] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[3] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[4] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[4] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[4] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[5] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[5] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[5] & $lessThanPrimeMask);
		$carry = ($carry >> 32) + $this->limbs[6] - 0xFFFFFFFF + 0xFFFFFFFF;
		$this->limbs[6] = (($carry & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[6] & $lessThanPrimeMask);
		$this->limbs[7] = (((($carry >> 32) + $this->limbs[7] - 0xFFFFFFFF + 0xFFFFFFFF) & 0xFFFFFFFF) & $greaterThanOrEqualToPrimeMask) | ($this->limbs[7] & $lessThanPrimeMask);
	}
	
	// Inverse
	public function inverse(): void {
	
		// Check if self is zero
		if(($this->limbs[0] | $this->limbs[1] | $this->limbs[2] | $this->limbs[3] | $this->limbs[4] | $this->limbs[5] | $this->limbs[6] | $this->limbs[7]) === 0) {
		
			// Throw error
			throw new \Exception("Result is undefined");
		}
		
		// Set accumulator to self
		$accumulator = $this->clone();
		
		// Raise self to the prime minus two
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
		$accumulator->multiply($accumulator);
		$this->multiply($accumulator);
	}
}


?>
