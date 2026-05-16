<?php

namespace Josmarh\JVZooIPN\Events;

use Josmarh\JVZooIPN\Models\JVProductTransaction;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefundReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public JVProductTransaction $transaction
    ){}
}