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
	security: 'is_granted("ROLE_USER")',
	paginationItemsPerPage: 10,
	provider: EntityToDtoStateProvider::class,
	processor: EntityDtoClassStateProcessor::class,
	stateOptions: new Options(entityClass: DragonTreasure::class)
)]
class DragonTreasureApi {
	#[ApiProperty(readable: false, writable: false, identifier: true)]
	public ?int $id = null;

	public ?string $name = null;
}