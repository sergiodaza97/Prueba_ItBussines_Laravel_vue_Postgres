<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait Sp
{

    public function executeReadSp(String $sp, Array $params = []):Array{
        $resp = [];
        $status = false;
        $this->sp_error = false;
        $this->sp_msg_error =  "";
        try {
            $data = DB::select($sp, $params);
            $status = true;
        } catch (\Throwable $th) {
            $data = $th->getMessage();
            try {
                $this->logSpFails($sp, $th->getMessage(), $params);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        if(!$status){
            $this->sp_error = true;
            $this->sp_msg_error =  $data;
        }

        return [
            'status' => $status,
            'data' => $data
        ];
    }

}

?>