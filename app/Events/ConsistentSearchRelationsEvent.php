<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsistentSearchRelationsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;
    public $tableId;
    public $text;
    public $id;


    /**
     * ConsistentSearchRelationsEvent constructor.
     * @param $table
     * @param $tableId
     * @param $text
     * @param $id
     */
    public function __construct($table, $tableId, $text, $id )
    {
        $this->table = $table;
        $this->tableId = $tableId;
        $this->text= $text;
        $this->id = $id;
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
