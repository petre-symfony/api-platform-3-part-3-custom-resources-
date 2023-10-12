<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\DragonTreasure;
use App\Entity\User;

#[ApiResource(
	shortName: 'User',
	paginationItemsPerPage: 5,
	stateOptions: new Options(entityClass: User::class)
)]
#[ApiFilter(SearchFilter::class, properties: [
	'username' => 'partial'
])]
class UserApi {
	public ?int $id = null;

	public ?string $email = null;

	public ?string $username = null;

	/**
	 * @var array<int, DragonTreasure>
	 */
	public array $dragonTreasures = [];
}