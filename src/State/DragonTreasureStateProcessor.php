<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\DragonTreasure;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;


class DragonTreasureStateProcessor implements ProcessorInterface {
	public function __construct(
		#[Autowire(service:PersistProcessor::class)] private ProcessorInterface $innerProcessor,
		private Security $security
	) {
	}

	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
		assert($data instanceof DragonTreasure);

		if ($data->getOwner() === null && $this->security->getUser()) {
			$data->setOwner($this->security->getUser());
		}

		$this->innerProcessor->process($data, $operation, $uriVariables, $context);

		$data->setIsOwnedByAuthenticatedUser(
			$this->security->getUser() === $data->getOwner()
		);

		return $data;

	}
}