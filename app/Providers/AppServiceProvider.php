<?php

namespace Plista\BurgeramtTermin\Providers;

use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;
use Plista\ReportServiceClient\Http\Client as ReportServiceClient;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->configure('statsd');
		$this->app->configure('services');

		$this->app->bind(ReportServiceClient::class, function ($app) {
			return new ReportServiceClient(
				config('services.report_service.base_url'),
				'de',
				[
					'x-plista-user-email'    => config('services.report_service.user'),
					'x-plista-user-password' => config('services.report_service.password'),
				]
			);
		});
	}
}
