<?php
namespace App\Services;

use App\AlertQue;
use App\Setting;
use Illuminate\Database\Eloquent\Collection;
use Datetime;
/**
 * アラートメールを送付するための処理
 */
class SendAlertMailService
{
    private $alertQue;
    private $setting;

    public function __construct(AlertQue $alertQue,Setting $setting)
    {
        $this->alertQue = $alertQue;
        $this->setting  = $setting;
    }
    /**
     * アラートメール未送信のレコード(sendflg=0)を全件、抽出する。
     *
     * @return Collection
     */
    public function getUnsentRecord():Collection
    {
        return $this->alertQue->where('sendflg',0)->get();
    }
    /**
     * 該当のセンサーIDで最新の送信時刻を取得する。
     *
     * @param integer $sensorId
     * @return string 最新の送信時刻
     */
    public function getLatestSentTime(int $sensorId):string
    {
        return $this->alertQue->where('sensor_id',$sensorId)->where('sendflg',1)->max('sendingtime');
    }
    /**
     * 時刻を比較して差分となる分を返却する。
     *
     * @param string $base
     * @param string $target
     * @return string
     */
    public function diffTime(string $base,string $target):int
    {
        $baseTime   = new Datetime($base);
        $targetTime = new Datetime($target);
        return ($baseTime->getTimestamp() - $targetTime->getTimestamp()) / 60;
    }
    public function getSettingsByProjectId(int $projectId):Collection
    {
        return $this->setting->where('project_id',$projectId)->where('settingName','ALERT_EMAIL')->get();
    }

}