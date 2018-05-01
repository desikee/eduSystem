<?php

namespace App\Console\Commands;

use App\Repositories\Promotion\PromotionStatisticsRepository;
use Illuminate\Console\Command;

class PlayerPayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:player_pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新新增玩家的付费信息';

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
	    $repository = new PromotionStatisticsRepository();
	    // 记录所有玩家的付费信息
	    $repository->updatePlayerPay();
    }
}
