<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\DragonTreasure;
use App\Entity\User;
use App\State\EntityDtoClassStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
	shortName: 'User',
	paginationItemsPerPage: 5,
	provider: EntityToDtoStateProvider::class,
	processor: EntityDtoClassStateProcessor::class
	,
	stateOptions: new Options(entityClass: User::class)
)]
#[ApiFilter(SearchFilter::class, properties: [
	'username' => 'partial'
])]
class UserApi {
	#[ApiProperty(readable: false, identifier: true)]
	public ?int $id = null;

	public ?string $email = null;

	public ?string $username = null;

	/**
	 * The plaintext password when being set or changed
	 */
	#[ApiProperty(readable: false)]
	public ?string $password = null;

	/**
	 * @var array<int, DragonTreasure>
	 */
	public array $dragonTreasures = [];

	#[ApiProperty(readable: false, writable: false)]
	public int $flameThrowingDistance = 0;
}