<?php

namespace Rezyon\Applications\Orders\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class OrderDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach($this->collection['cart'][0]['tickets'] as $ticket) {
            $data[] = [
                'id' => $ticket['id'],
                'assigned' => $ticket['owner'] ?? false,
                'code' => $ticket['code'],
                'start_date' => $ticket['start_time'],
                'end_date' => $ticket['end_time'],
                'used_at' => $ticket['used_at'] ?? false,
            ];
        }
        return $data;
    }
}
