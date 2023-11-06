<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class DragonTreasureStateProcessor implements ProcessorInterface {
	public function __construct(
		private EntityDtoClassStateProcessor $innerProcessor
	) {
	}

	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
		dd($context['previous_data'], $data);
		return $this->innerProcessor->process($data, $operation, $uriVariables, $context);
	}
}
