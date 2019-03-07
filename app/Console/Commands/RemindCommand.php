<?php

namespace App\Console\Commands;

use App\ScheduleCustomer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     */
    public function handle()
    {
        $data   =   new ScheduleCustomer();
        $data   =   $data->where('time', '>=', Carbon::now()->addMinutes(29))->where('time','<', Carbon::now()->addMinutes(30))->get();
        Log::info('zz');
        Log::info(Carbon::now()->addMinutes(29));
        Log::info(Carbon::now()->addMinutes(35));
        Log::info($data->toArray());
        foreach ($data as $item) {
            Log::info($item->id);
            notify([$item->user_id], 'Nhắc lịch hẹn khách hàng', "\"".$item->content."\" với ".$item->customer()->first()->name, route('customerCare', ['id'=>$item->customer_id]));
        }
    }
}
