<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Entity\DragonTreasure;
use App\State\EntityDtoClassStateProcessor;
use App\State\EntityToDtoStateProvider;
use App\Validator\IsValidOwner;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource(
	shortName: 'Treasure',
	operations: [
		new Get(),
		new GetCollection(),
		new Post(
			security: 'is_granted("ROLE_TREASURE_CREATE")'
		),
		new Patch(
			security: 'is_granted("EDIT", object)'
		),
		new Delete(
			security: 'is_granted("ROLE_ADMIN")'
		)
	],
	paginationItemsPerPage: 10,
	provider: EntityToDtoStateProvider::class,
	processor: EntityDtoClassStateProcessor::class,
	stateOptions: new Options(entityClass: DragonTreasure::class)
)]
class DragonTreasureApi {
	#[ApiProperty(readable: false, writable: false, identifier: true)]
	public ?int $id = null;

	#[NotBlank]
	public ?string $name = null;

	#[NotBlank]
	public ?string $description = null;

	#[GreaterThanOrEqual(0)]
	public int $value = 0;

	#[GreaterThanOrEqual(0)]
	#[LessThanOrEqual(10)]
	public int $coolFactor = 0;

	// Object is null ONLY during deserialization: so this allows isPublished
	// to be writable in ALL cases (which is ok because the operations are secured).
	// During serialization, object will always be a DragonTreasureApi, so our
	// voter is called.
	#[ApiProperty(security: 'object === null or is_granted("EDIT", object)')]
	public bool $isPublished = false;

	#[IsValidOwner]
	public ?UserApi $owner = null;

	public ?string $shortDescription = null;

	public ?string $plunderedAtAgo = null;

	public ?bool $isMine = null;
}