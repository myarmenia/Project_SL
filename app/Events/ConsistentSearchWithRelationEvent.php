<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsistentSearchWithRelationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;
    public $id;
    public $type;


    /**
     * ConsistentSearchWithRelationEvent constructor.
     * @param $table
     * @param $id
     * @param $type
     */
    public function __construct($table, $id, $type)
    {
        $this->table = $table;
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
