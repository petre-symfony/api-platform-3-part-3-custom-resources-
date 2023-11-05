<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\DragonTreasure;
use App\State\EntityDtoClassStateProcessor;
use App\State\EntityToDtoStateProvider;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

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

	#[NotBlank]
	public ?string $name = null;

	#[NotBlank]
	public ?string $description = null;

	#[GreaterThanOrEqual(0)]
	public int $value = 0;

	#[GreaterThanOrEqual(0)]
	#[LessThanOrEqual(10)]
	public int $coolFactor = 0;

	public ?UserApi $owner = null;

	public ?string $shortDescription = null;

	public ?string $plunderedAtAgo = null;

	public ?bool $isMine = null;
}