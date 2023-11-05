<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\DragonTreasure;
use App\State\EntityDtoClassStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
	shortName: 'Treasure',
	paginationItemsPerPage: 10,
	provider: EntityToDtoStateProvider::class,
	processor: EntityDtoClassStateProcessor::class,
	stateOptions: new Options(entityClass: DragonTreasure::class)
)]
class DragonTreasureApi {
	#[ApiProperty(readable: false, writable: false, identifier: true)]
	public ?int $id = null;

	public ?string $name = null;

	public ?string $description = null;

	public int $value = 0;

	public int $coolFactor = 0;

	public ?UserApi $owner = null;

	public ?string $shortDescription = null;

	public ?string $plunderedAtAgo = null;

	public ?bool $isMine = null;
}