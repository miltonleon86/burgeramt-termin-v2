<?php

namespace Tests;

use Faker\Generator;
use League\StatsD\Client;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{
	/**
	 * @var Generator
	 */
	public $faker;

	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication()
	{
		return require __DIR__ . '/../bootstrap/app.php';
	}

	public function setUp(): void
	{
		parent::setUp();

		$faker = \Faker\Factory::create();

		$faker->addProvider(new \Faker\Provider\de_DE\Company($faker));
		$faker->addProvider(new \Faker\Provider\at_AT\Payment($faker));
		$faker->addProvider(new \Faker\Provider\en_NG\Address($faker));
		$faker->addProvider(new \Faker\Provider\Miscellaneous($faker));
		$this->faker = $faker;

		$statsDMock = $this->getMockBuilder(Client::class)
			->disableOriginalConstructor()
			->setMethods(['increment', 'startTiming', 'endTiming'])
			->getMock();

		app()->singleton('statsd', function () use ($statsDMock) {
			return $statsDMock;
		});
	}
}
