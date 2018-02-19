<?php

namespace App\Helpers;

class Flash
{
    public static function success($msg)
    {
        session()->flash('notification', [
            'type' => 'success',
            'msg' => $msg,
        ]);
    }

    public static function error($msg)
    {
        session()->flash('notification', [
            'type' => 'error',
            'msg' => $msg,
        ]);
    }
}
