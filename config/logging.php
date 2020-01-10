<?php

use Monolog\Handler\StreamHandler;

return [
	'default' => env('LOG_CHANNEL', 'stack'),

	'channels' => [
		'stack'   => [
			'driver'   => 'stack',
			'channels' => ['stderr', 'graylog'],
		],
		'stderr'  => [
			'driver'    => 'monolog',
			'handler'   => StreamHandler::class,
			'formatter' => env('LOG_STDERR_FORMATTER'),
			'with'      => [
				'stream' => 'php://stderr',
			],
		],
		'graylog' => [
			'driver'     => 'custom',
			'via'        => \Plista\LaravelMonolog\Factories\GelfLoggerFactory::class,
			'level'      => 'info',
			'host'       => env('GRAYLOG_HOST'),
			'port'       => env('GRAYLOG_PORT'),
			'processors' => [
				Monolog\Processor\UidProcessor::class,
				\Monolog\Processor\WebProcessor::class,
				\Monolog\Processor\IntrospectionProcessor::class,
				\Monolog\Processor\ProcessIdProcessor::class,
				\Monolog\Processor\GitProcessor::class,
				\JK\Monolog\Processor\RequestHeaderProcessor::class,
				[\Plista\LaravelMonolog\Processors\EnvironmentProcessor::class, [env('APP_ENV')]],
				\Plista\LaravelMonolog\Processors\PlistaTeamProcessor::class,
				[\Plista\LaravelMonolog\Processors\PlistaPlatformProcessor::class, ['burgeramt_termin']],
			],
		],
	],
];
