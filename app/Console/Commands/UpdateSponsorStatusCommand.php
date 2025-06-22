<?php

namespace App\Console\Commands;

use App\Models\PatientSponsor;
use Illuminate\Console\Command;

class UpdateSponsorStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of Sponsors based of date range';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $currentDate = now();
        PatientSponsor::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->update(['status' => 'Active']);

        PatientSponsor::where(function ($query) use ($currentDate){
            $query->where('end_date', '<', $currentDate)
                  ->orWhere('start_date', '>', $currentDate);
        })->update(['status' => 'Inactive']);

        $this->info('Patient Sponsor status Update Successfully');
    }
}
