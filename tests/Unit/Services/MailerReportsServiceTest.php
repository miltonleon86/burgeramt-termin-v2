<?php

namespace Tests\Unit\Services;

use Carbon\Carbon;
use PHPUnit\Framework\MockObject\MockObject;
use Plista\ReportServiceClient\Http\Client as ReportServiceClient;
use Tests\TestCase;

class BurgeramtTerminServiceTest extends TestCase
{
	/**
	 * @var MockObject | ReportServiceClient
	 */
	private $reportServiceClient;

	public function setUp(): void
	{
		parent::setUp();

		$this->reportServiceClient = $this->getMockBuilder(ReportServiceClient::class)
			->disableOriginalConstructor()
			->setMethods([''])
			->getMock();
	}

	public function testReportsPreparedSuccessfully(): void
	{

	}
}
