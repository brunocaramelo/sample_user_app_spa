<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use App\Models\User;

class UserCreated
{
    use Dispatchable, InteractsWithQueue, InteractsWithBroadcasting;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
