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
        foreach ($admins as $admin) {
            if ($admin->chat_id && $admin->token) {
                $text = urlencode(
                    sprintf(
                        "Order Created.\n
                        %s\n
                        %s\n
                        Date : %s\n
                        Hire : Rs.%s\n
                        %s",
                        $event->order->trip->truck,
                        $event->order,
                        $event->order->when->format('d-m-Y'),
                        $event->order->hire,
                        $event->order
                    )
                );
                $client->get("https://api.telegram.org/bot{$admin->token}/sendMessage?chat_id={$admin->chat_id}&text={$text}");
                Log::info("{$admin->name} has been sent a msg on Telegram");
            }
        }
    }
}
