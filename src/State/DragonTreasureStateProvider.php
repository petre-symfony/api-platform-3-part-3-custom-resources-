<?php

namespace App\State;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\DragonTreasure;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class DragonTreasureStateProvider implements ProviderInterface {
	public function __construct(
		#[Autowire(service: ItemProvider::class)] private ProviderInterface $itemProvider,
		#[Autowire(service: CollectionProvider::class)] private ProviderInterface $collectionProvider,
		private Security $security
	){

	}
	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null {
		if ($operation instanceof CollectionOperationInterface) {
			/**
			 * @var iterable<DragonTreasure> $paginator
			 */
			$paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

			foreach($paginator as $treasure) {
				$treasure->setIsOwnedByAuthenticatedUser(
					$this->security->getUser() === $treasure->getOwner()
				);
			}

			return $paginator;
		}

		$treasure = $this->itemProvider->provide($operation, $uriVariables, $context);

		if (!$treasure instanceof DragonTreasure){
			return null;
		}

		$treasure->setIsOwnedByAuthenticatedUser(
			$this->security->getUser() === $treasure->getOwner()
		);

		return $treasure;
	}
}
