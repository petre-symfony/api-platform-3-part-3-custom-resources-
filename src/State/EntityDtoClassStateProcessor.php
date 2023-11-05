<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Doctrine\Common\State\RemoveProcessor;
use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\UserApi;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfonycasts\MicroMapper\MicroMapperInterface;

class EntityDtoClassStateProcessor implements ProcessorInterface {
	public function __construct(
		#[Autowire(service: PersistProcessor::class)] private ProcessorInterface $persistProcessor,
		#[Autowire(service: RemoveProcessor::class)] private ProcessorInterface $removeProcessor,
		private MicroMapperInterface $microMapper
	) {

	}
	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
		assert($data instanceof UserApi);

		$entity = $this->mapDtoToEntityData($data);

		if ($operation instanceof DeleteOperationInterface) {
			$this->removeProcessor->process($entity, $operation, $uriVariables, $context);

			return null;
		}

		$this->persistProcessor->process($entity, $operation, $uriVariables, $context);
		$data->id = $entity->getId();

		return $data;
	}

	private function mapDtoToEntityData(object $dto): object {
		return $this->microMapper->map($dto, User::class);
	}
}
