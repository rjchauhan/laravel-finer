<?php

namespace Rjchauhan\LaravelFiner\Pdf;

use Illuminate\Support\Str;

abstract class Pdf implements PdfContract
{
    protected $view;

    /** @var array */
    protected $options = [];

    /** @return array */
    public abstract function data();

    public function download()
    {
        return $this->pdf()->download($this->filename());
    }

    public function render()
    {
        return $this->pdf()->stream();
    }

    public function pdf()
    {
        // merging customized options with default options.
        $options = array_merge(config('dompdf.defines'), $this->options);

        return \PDF::loadView($this->view(), $this->data())
            ->setOptions($options);
    }

    public function view()
    {
        return config('laravel-finer.pdf.views') . '.' . $this->viewName();
    }

    public function locale($locale)
    {
        app()->setLocale($locale);

        return $this;
    }

    public function viewName()
    {
        return isset($this->view)
            ? $this->view
            : Str::kebab(class_basename($this));
    }

    public function filename()
    {
        return str_replace('_', ' ', Str::title(Str::snake(class_basename($this)))) . '.pdf';
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
