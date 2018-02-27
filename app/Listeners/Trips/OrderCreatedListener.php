<?php

namespace App\Listeners\Trips;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $client = new Client();
        $admins = User::role('admin')->get();
        $event->order->load('loadingPoint','unloadingPoint');
        foreach ($admins as $admin) {
            if ($admin->chat_id && $admin->token) {
                $text = urlencode(
                    sprintf("Order Created.\r\n%s\r\n%s\r\nDate : %s\r\nHire : ₹ %s\r\nLink : %s",
                        $event->order->trip->truck,$event->order,$event->order->when->format('d-m-Y'),
                        $event->order->hire,url('http://fleetomata.truckjee.com/trips/' . $event->order->trip_id))
                    );
                $client->get("https://api.telegram.org/bot{$admin->token}/sendMessage?chat_id={$admin->chat_id}&text={$text}");
                Log::info("{$admin->name} has been sent a msg on Telegram");
            }
        }
    }
}
