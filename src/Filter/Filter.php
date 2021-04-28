<?php

namespace Rjchauhan\LaravelFiner\Filter;

use Illuminate\Http\Request;

abstract class Filter implements FilterContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Custom filter key value pairs
     */
    protected $values = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set custom filter key value pairs
     */
    public function values(array $values = [])
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Apply the filters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    private function getFilters()
    {
        if (count($this->values)) {
            return array_filter(array_only($this->values, $this->filters));
        }

        return array_filter($this->request->only($this->filters));
    }
}
