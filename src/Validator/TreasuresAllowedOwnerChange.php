<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class TreasuresAllowedOwnerChange extends Constraint {
	/*
	 * Any public properties become valid options for the annotation.
	 * Then, use these in your validator class.
	 */
	public string $message = 'One of the treasures illegally changed owners.';
}
