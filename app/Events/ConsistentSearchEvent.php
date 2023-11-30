<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsistentSearchEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $field;
    public $text;
    public $type;
    public $fileId;


    /**
     * ConsistentSearchEvent constructor.
     * @param $field
     * @param $text
     * @param $type
     * @param $fileId
     */
    public function __construct($field, $text, $type, $fileId=null)
    {
        $this->field = $field;
        $this->text= $text;
        $this->type= $type;
        $this->fileId= $fileId;
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
