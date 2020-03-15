<?php

namespace Rjchauhan\LaravelFiner\Action;

interface ActionContract
{
    /**
     * Executes the action.
     *
     * @return mixed
     */
    public function execute();

    /**
     * Post processing after action executes using queue.
     *
     * @return void
     */
    public function after();

    /**
     * Get specific property.
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getProperty($key, $default = null);

    /**
     * Get all properties.
     *
     * @return array
     */
    public function getProperties();

    /**
     * Set specific property.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setProperty($key, $value);

    /**
     * Set extra properties.
     *
     * @param array $properties
     * @return $this
     */
    public function setProperties(array $properties);
}
