<?php

namespace App\Console\Commands;

use App\Models\SeatSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReleaseSeatLocks extends Command
{
    protected $signature = 'seats:release-locks';
    protected $description = 'Release seat locks after a specified time period';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        // Define the time limit for releasing locks
        $lockTimeLimit = Carbon::now()->subMinutes(10);

        // Find all seats that are locked and the lock time has expired
        $seats = SeatSchedule::where('is_locked', 1)
            ->where('locked_at', '<', $lockTimeLimit)
            ->get();

        // Release the locks
        foreach ($seats as $seat) {

            Log::info('Releasing lock for seat ' . $seat->id);
            $seat->is_locked = 0;
            $seat->locked_at = null;
            $seat->save();
        }

        $this->info('Seat locks released successfully.');
    }
}
