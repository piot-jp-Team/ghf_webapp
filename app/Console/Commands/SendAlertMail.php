<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SendAlertMailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;

class SendAlertMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:alert-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Alert Mail to User.';

    /**
     * アラートメール送信クラスのインスタンス
     *
     * @var SendAlertMailService
     */
    protected $sendMailService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SendAlertMailService $sendAlertMailService)
    {
        parent::__construct();
        $this->sendMailService = $sendAlertMailService;
    }

    /**
     * メール送信を行う処理です。
     *
     * @return mixed
     */
    public function handle()
    {
        $unsentRecords = $this->sendMailService->getUnsentRecord();
        foreach ($unsentRecords as $unsent){
            $latestTime = $this->sendMailService->getLatestSentTime($unsent->sensor_id);
            $diffTime   = $this->sendMailService->diffTime(Carbon::now()->toDateTimeString(),$latestTime);
            $settings   = $this->sendMailService->getSettingsByProjectId($unsent->project_id);
            if($diffTime > $settings->max('settingValue')){
                $unsent->sendflg = '1';
                Mail::to($settings->pluck('settingString')->toArray())
                ->send(new Alertmail($unsent->sensor->name,$unsent->sddvalue,$unsent->limitupper,$unsent->limitunder));
            }else{
                $unsent->sendflg = '2';
            }
            $unsent->sendingtime = Carbon::now();
            $unsent->save();
        }
        
    }
}
