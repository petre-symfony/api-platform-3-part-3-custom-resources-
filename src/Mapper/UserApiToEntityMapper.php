<?php

namespace App\Mapper;

use App\ApiResource\UserApi;
use App\Entity\User;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: UserApi::class, to: User::class)]
class UserApiToEntityMapper implements MapperInterface {
	public function load(object $from, string $toClass, array $context): object {
		dd($from, $toClass);
	}

	public function populate(object $from, object $to, array $context): object {
		// TODO: Implement populate() method.
	}

}