<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CancelExpiredBorrows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrows:cancel_expired_borrows';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto cancel borrowing has not been accepted (Set borrowing status as 4 out of the expired borrowing records)';

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
        try {
            DB::beginTransaction();

            \App\Borrow::where('status', 0)
                ->where('end_date', '<', Carbon::now())
                ->update(['status' => 2]);

            DB::commit();

            //send output to the console
            $this->info('Auto cancel expired borrowing!');
        } catch (\Exception $e) {
            DB::rollBack();

            $this->error($e->getMessage());
        }
    }
}
