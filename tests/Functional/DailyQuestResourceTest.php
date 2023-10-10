<?php

namespace App\Tests\Functional;

use App\Factory\DragonTreasureFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class DailyQuestResourceTest extends ApiTestCase {
	use ResetDatabase;
	use Factories;

	public function testPatchCanUpdateStatus() {
		//quests needs at least some treasures to be available
		DragonTreasureFactory::createMany(5);

		$day = new \DateTime('-2 day');
		$this->browser()
			->patch('/api/quests/' . $day->format('Y-m-d'), [
				'json' => [
					'status' => 'completed'
				],
				'headers' => [
					'Content-type' => 'application/merge-patch+json'
				]
			])
			->assertStatus(200)
			->assertJsonMatches('status', 'completed')
		;
	}
}