<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * Display timestamps in user's timezone
     */
    protected function asDateTime($value)
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if (\Auth::check()) {
            $value = parent::asDateTime($value)->setTimezone(\Auth::user()->timezone);
        } else {
            $value = parent::asDateTime($value);
        }

        return $value;
    }
}
