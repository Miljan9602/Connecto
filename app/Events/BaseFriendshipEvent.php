<?php

namespace App\Events;

use App\Model\Friendship;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BaseFriendshipEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Friendship
     */
    protected $friendship;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Friendship $friendship)
    {
        $this->friendship = $friendship;
    }

    /**
     * @return Friendship
     */
    public function getFriendship(): Friendship
    {
        return $this->friendship;
    }
}
