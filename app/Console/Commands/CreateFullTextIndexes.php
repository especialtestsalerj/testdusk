<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Models\Visitor;
class CreateFullTextIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sigvisitas:create-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all full text search indexes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Visitor::disableGlobalScopes();
        Artisan::call('scout:sync-index-settings');
        Artisan::call('scout:import', [
            'model' => 'App\\Models\\Visitor',
        ]);
        $this->info(Artisan::output());
        Visitor::enableGlobalScopes();

        return Command::SUCCESS;
    }
}
