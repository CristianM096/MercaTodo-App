<?php

namespace App\Console\Commands;

use App\Jobs\GetInformationJob;
use Illuminate\Console\Command;

class GetInformationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consult:webcheckout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launches a request to webcheckout payment gateway';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //dispatch_sync((new GetInformationJob()));
        GetInformationJob::dispatch();
    }
}
