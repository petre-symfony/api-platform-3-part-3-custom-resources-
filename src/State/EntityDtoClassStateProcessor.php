<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class EntityDtoClassStateProcessor implements ProcessorInterface {
	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void {
		dd($data);
	}
}
