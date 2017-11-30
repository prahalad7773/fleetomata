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
}
