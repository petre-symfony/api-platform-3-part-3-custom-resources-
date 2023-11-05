<?php

namespace App\Mapper;

use App\ApiResource\UserApi;
use App\Entity\User;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: User::class, to: UserApi::class)]
class UserEntityToApiMapper implements MapperInterface {
	public function load(object $from, string $toClass, array $context): object {
		$entity = $from;
		assert($entity instanceof User);

		$dto = new UserApi();
		$dto->id = $entity->getId();

		return $dto;
	}

	public function populate(object $from, object $to, array $context): object {
		$entity = $from;
		$dto = $to;
		assert($entity instanceof User);
		assert($dto instanceof UserApi);
		
		$dto->id = $entity->getId();
		$dto->email = $entity->getEmail();
		$dto->username = $entity->getUsername();
		$dto->dragonTreasures = $entity->getPublishedDragonTreasures()->toArray();
		$dto->flameThrowingDistance = rand(1, 10);

		return $dto;
	}

}