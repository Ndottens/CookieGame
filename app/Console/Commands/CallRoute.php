<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

class CallRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:call {uri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artisan route:call /route';

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
     * @return mixed
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $request = Request::create($this->argument('uri'), 'GET');
        $this->info(app()->make(Kernel::class)->handle($request));
    }
}
