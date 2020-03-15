<?php

namespace Rjchauhan\LaravelFiner\Action;

use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

abstract class Action implements ActionContract
{
    /** @var Model */
    protected $model;

    /** @var array */
    private $properties = [];

    /** @var User|Authenticatable */
    protected $performer;

    /**
     * Action constructor.
     *
     * @param Model $model
     * @param User|Authenticatable $performer
     */
    public function __construct(Model $model, User $performer = null)
    {
        $this->model = $model;
        $this->performer = $performer ?: auth()->user();
    }

    /**
     * Perform action on model.
     *
     * @return mixed
     */
    abstract protected function perform();

    /**
     * Check if given action can be performed.
     *
     * @return bool
     */
    protected function canBePerformed()
    {
        return true;
    }

    /**
     * Run pre action scripts.
     */
    protected function before()
    {
        // pre processing goes here...
    }

    /**
     * Run post action scripts.
     */
    public function after()
    {
        // post processing goes here...
    }

    /**
     * Executes the action.
     *
     * @return mixed
     */
    public function execute()
    {
        if ($this->canBePerformed()) {
            $this->before();

            $this->perform();

            ExecutePostActionJob::dispatch($this);
        }

        return $this->model;
    }

    /**
     * Get specific property.
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getProperty($key, $default = null)
    {
        return data_get($this->properties, $key, $default);
    }

    /**
     * Get all properties.
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set specific property.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setProperty($key, $value)
    {
        data_set($this->properties, $key, $value);

        return $this;
    }

    /**
     * Set extra properties.
     *
     * @param array $properties
     * @return $this
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get performer user id.
     *
     * @return int|mixed
     */
    protected function getPerformerId()
    {
        return $this->performer->id;
    }
}
