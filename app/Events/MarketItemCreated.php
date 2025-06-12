<?php

namespace App\Events;

use App\Models\MarketItem;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MarketItemCreated
{
    use Dispatchable, SerializesModels;

    public $item;

    public function __construct(MarketItem $item)
    {
        $this->item = $item;
    }
}
