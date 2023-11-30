<?php
namespace App\Traits;

use App\Models\Notification;
use Illuminate\Notifications\Notifiable;

trait NotifiableTrait
{
    use Notifiable;

    /**
     * @return mixed
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}