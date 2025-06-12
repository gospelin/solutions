<?php

namespace App\Events;

use App\Models\FreeApp;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FreeAppUpdated
{
    use Dispatchable, SerializesModels;

    public $freeApp;

    public function __construct(FreeApp $freeApp)
    {
        $this->freeApp = $freeApp;
    }
}
