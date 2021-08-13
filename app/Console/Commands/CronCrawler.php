<?php

namespace App\Console\Commands;

use App\Services\CrawlerService;

use Illuminate\Console\Command;

class CronCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $crawlerService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CrawlerService $crawlerService)
    {
        parent::__construct();
        $this->crawlerService = $crawlerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->crawlerService->astroCrawler();
    }
}
