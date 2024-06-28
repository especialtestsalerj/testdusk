<?php

namespace App\Console\Commands;

use App\Models\Reservation;
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
        $models = [
            Visitor::class,
            Reservation::class,

        ];

        foreach ($models as $model) {
            $model::disableGlobalScopes();

            Artisan::call('scout:delete-index', [
                'name' => (new $model)->searchableAs(),
            ]);
            $this->info(Artisan::output());

            Artisan::call('scout:sync-index-settings');

            Artisan::call('scout:import', [
                'model' => $model,
            ]);
            $this->info(Artisan::output());

            $model::enableGlobalScopes();
        }

        return Command::SUCCESS;
    }
}
