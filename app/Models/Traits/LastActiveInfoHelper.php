<?php
namespace App\Models\Traits;
use Carbon\Carbon;
trait LastActiveInfoHelper{
    protected $hash_tabel_prefix='we8bbs_last_active_at_';
    protected $field_prefix = 'user_';
    public function recordLastActiveAt(){
        $date = Carbon::now()->toDateString();
        //bbschat_last_active_at_2024_07_04
        $hash_table_name = $this->hash_tabel_prefix.$date;
        $hash_field_name = $this->field_prefix.$this->id;
        $now_time = Carbon::now()->toDateTimeString();

        //数据以哈西表的形式写入redis
        Redis::hSet($hash_table_name,$hash_field_name,$now_time);
    }
}
