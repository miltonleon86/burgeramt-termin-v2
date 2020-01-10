<?php

return [
	'host'                      => env('STATSD_HOST', 'graphite'),
	'port'                      => env('STATSD_PORT', 8125),
	'namespace'                 => env('STATSD_NAMESPACE', ''),
	'throwConnectionExceptions' => true,
];
