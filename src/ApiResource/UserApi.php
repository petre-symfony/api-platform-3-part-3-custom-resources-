<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Entity\User;
use App\State\EntityDtoClassStateProcessor;
use App\State\EntityToDtoStateProvider;
use App\Validator\TreasuresAllowedOwnerChange;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource(
	shortName: 'User',
	operations: [
		new Get(),
		new GetCollection(),
		new Post(
			security: 'is_granted("PUBLIC_ACCESS")',
			validationContext: ['groups' => ['Default', 'postValidation']]
		),
		new Patch(
			security: 'is_granted("ROLE_USER_EDIT")'
		),
		new Delete()
	],
	security: 'is_granted("ROLE_USER")',
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
	#[ApiProperty(readable: false, writable: false, identifier: true)]
	public ?int $id = null;

	#[NotBlank]
	#[Email]
	public ?string $email = null;

	#[NotBlank]
	public ?string $username = null;

	/**
	 * The plaintext password when being set or changed
	 */
	#[ApiProperty(readable: false)]
	#[NotBlank(groups: ['postValidation'])]
	public ?string $password = null;

	/**
	 * @var array<int, DragonTreasureApi>
	 */
	#[TreasuresAllowedOwnerChange]
	public array $dragonTreasures = [];

	#[ApiProperty(writable: false)]
	public int $flameThrowingDistance = 0;
}