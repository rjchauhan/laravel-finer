<?php

namespace Rjchauhan\LaravelFiner\Pdf;

interface PdfContract
{
    /**
     * Apply filters.
     *
     * @return array
     */
    public function data();
}
