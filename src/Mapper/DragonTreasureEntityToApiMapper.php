<?php

namespace App\Mapper;

use App\ApiResource\DragonTreasureApi;
use App\Entity\DragonTreasure;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: DragonTreasure::class, to: DragonTreasureApi::class)]
class DragonTreasureEntityToApiMapper implements MapperInterface {
	public function load(object $from, string $toClass, array $context): object {
		$entity = $from;
		assert($entity instanceof DragonTreasure);

		$dto = new DragonTreasureApi();
		$dto->id = $entity->getId();

		return $dto;
	}

	public function populate(object $from, object $to, array $context): object {
		$entity = $from;
		$dto = $to;
		assert($entity instanceof DragonTreasure);
		assert($dto instanceof DragonTreasureApi);

		$dto->name = $entity->getName();

		return $dto;
	}

}