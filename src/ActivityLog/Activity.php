<?php

namespace Rjchauhan\LaravelFiner\ActivityLog;

use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity as SpatieActivity;
use Spatie\Activitylog\Contracts\Activity as SpatieActivityContract;

abstract class Activity extends SpatieActivity implements SpatieActivityContract
{
    public function getCauserNameAttribute()
    {
        return $this->causer
            ? $this->causer->name
            : config('laravel-finer.activity-logger.default_causer');
    }

    public function getDisplayTimeAttribute()
    {
        if ($this->created_at->lt(Carbon::now()->subHour())) {
            return $this->created_at->toDateTimeString();
        }

        return $this->created_at->diffForHumans();
    }

    public function getContentAttribute()
    {
        if (view()->exists($view = $this->getView())) {
            $this->load('subject', 'causer');

            return view($view, [
                'subject'    => $this->subject,
                'causer'     => $this->causer,
                'activity'   => $this,
                'properties' => $this->properties,
            ])->render();
        }

        return str_beautify($this->description);
    }

    private function getView()
    {
        return config('laravel-finer.activity-logger.views') . '.' . $this->description;
    }
}
