<?php

namespace Rezyon\Applications\Tickets\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class TicketsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();

        // Geçmiş etkinlikleri filtrele, gerekli attribute'ları ekle ve tarihlerine göre grupla
        $pastEvents = $this->collection->filter(function ($event) {
            return Carbon::parse($event->start_time)->isPast();
        })->sortByDesc('start_time')->map(function ($event) use ($locale) {
            return [
                "id" => $event->id,
                "start_date" => $event->start_time,
                "count" => $this->collection->count(),
                "used_at" => $event->used_at,
                "date" => Carbon::parse($event->start_time)->toDateString(),
                "session" => $event->cart->session ? [
                    "start_time" => $event->cart->session->start_time->format('H:i:s'),
                    "end_time" => $event->cart->session->end_time->format('H:i:s')
                ] : null,
                "activity" => [
                    "name" => $event->activity->getTranslations('name', [$locale])[$locale] ?? null,
                    "image" => $event->activity->images->first()->path,
                ]
            ];
        })->values()->groupBy('date')->map(function ($group, $date) {
            return [
                'date' => $date,
                'events' => $group->values()
            ];
        })->sortByDesc('date')->values();

        // Gelecek etkinlikleri filtrele, gerekli attribute'ları ekle ve tarihlerine göre grupla
        $upcomingEvents = $this->collection->filter(function ($event) {
            return Carbon::parse($event->start_time)->isFuture();
        })->map(function ($event) use ($locale) {
            return [
                "id" => $event->id,
                "start_date" => $event->start_time,
                "count" => $this->collection->count(),
                "used_at" => $event->used_at,
                "date" => Carbon::parse($event->start_time)->toDateString(),
                "session" => $event->cart->session ? [
                    "start_time" => $event->cart->session->start_time->format('H:i:s'),
                    "end_time" => $event->cart->session->end_time->format('H:i:s')
                ] : null,
                "activity" => [
                    "name" => $event->activity->getTranslations('name', [$locale])[$locale] ?? null,
                    "image" => $event->activity->images->first()->path,
                ]
            ];
        })->values()->groupBy('date')->map(function ($group, $date) {
            return [
                'date' => $date,
                'events' => $group->values()
            ];
        })->sortBy('date')->values();

        return [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents
        ];
    }
}