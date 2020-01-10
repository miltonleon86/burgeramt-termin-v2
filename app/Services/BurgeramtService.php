<?php

namespace Plista\BurgeramtTermin\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Plista\ReportServiceClient\Http\Client as ReportServiceClient;
use Plista\BurgeramtTermin\Exceptions\BurgeramtTerminException;

class BurgeramtService
{
	/**
	 * @var ReportServiceClient
	 */
	private $reportServiceClient;

	public function __construct(ReportServiceClient $reportServiceClient)
	{
		$this->reportServiceClient = $reportServiceClient;

	}

	/**
	 * Run service.
	 *
	 * @param int $hour
	 *
	 * @throws BurgeramtTerminException
	 * @throws \Throwable
	 */
	public function run(int $hour = null): void
	{
		$hour = $hour ?? (new Carbon())->format('Hi');

		try {

			Log::info('Sending mails for hour: ' . $hour . '. [PID: ' . getmypid() . ']');
			$this->reportServiceClient->sendMails(['hour' => $hour]);

		} catch (\Throwable $ex) {
			Log::critical('Cannot send reports for hour ' . $hour . '. Reason: ' . $ex->getMessage());

			throw new BurgeramtTerminException('Cannot send mails for ' . $hour . '. Reason: ' . $ex->getMessage());
		}
	}
}
