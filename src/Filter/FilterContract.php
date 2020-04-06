<?php

namespace Rjchauhan\LaravelFiner\Filter;

interface FilterContract
{
    /**
     * Apply filters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder);
}
