<?php

namespace Plista\BurgeramtTermin\Console\Commands;

use Illuminate\Console\Command;
use Plista\BurgeramtTermin\Services\BurgeramtService;

class CheckAvailability extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reports:mails {hour?}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */

	protected $description = 'Send reports that were generated for a given hour.';

	public function handle()
	{
		$this->info('Running...');

		$hour = $this->argument('hour');

		app(BurgeramtService::class)->run($hour);

		$this->info('Done.');
	}
}
