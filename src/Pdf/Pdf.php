<?php

namespace Rjchauhan\LaravelFiner\Pdf;

use Dompdf\Dompdf;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

abstract class Pdf
{
    protected $view;

    public abstract function data();

    public function download()
    {
        $dompdf = new Dompdf;

        $dompdf->loadHtml($this->pdf()->render());

        $dompdf->render();

        return new Response($dompdf->output(), 200, [
            'Content-Description'       => 'File Transfer',
            'Content-Disposition'       => 'attachment; filename="' . $this->filename() . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type'              => 'application/pdf',
        ]);
    }

    public function render()
    {
        return $this->pdf();
    }

    public function pdf()
    {
        return view($this->view(), $this->data());
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
        if (isset($this->view)) {
            return $this->view;
        }

        return Str::kebab(class_basename($this));
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
