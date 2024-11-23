<?php

namespace App\Filament\Resources\MaintenanceScheduleResource\Widgets;

use App\Models\MaintenanceSchedule;
use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{

    protected static ?string $maxHeight = '300px';

    public static function canView(): bool
    {
        return true;
    }

    public function fetchEvents(array $fetchInfo): array
    {
        $event = MaintenanceSchedule::query()
         ->where('status', '!=', 'completed') // Fetch only completed schedules
            ->where('scheduled_date', '>=', $fetchInfo['start']) // Fetch events within the date range
            ->where('scheduled_date', '<=', $fetchInfo['end']) // Ensure scheduled_date is within the range
            ->get()
            ->map(
                fn(MaintenanceSchedule $schedule) => [
                    'id' => $schedule->id,
                    'title' => $schedule->acUnit->unit_code, // Use the type (routine, repair, inspection) as the title
                    'start' => $schedule->scheduled_date->toIso8601String(), // Convert to ISO 8601 string format
                    'end' => $schedule->completed_date ? $schedule->completed_date->toIso8601String() : $schedule->scheduled_date->toIso8601String(), // Use completed_date if available
                    'url' => \App\Filament\Resources\MaintenanceScheduleResource::getUrl(
                        name: 'view',
                        parameters: ['record' => $schedule]
                    ),
                    'shouldOpenUrlInNewTab' => true, // Set to open in a new tab
                ]
            )
            ->all();

        return $event;
    }

    protected static string $view = 'filament.resources.maintenance-schedule-resource.widgets.calendar-widget';
}
