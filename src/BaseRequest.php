<?php

namespace Zeus\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseRequest
{
    protected $rawData;
    protected $data;
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
        $this->rawData = $request ? $request->all() : null;

        if ($this->rawData !== null) {
            $this->handleData();
        }
    }

    public static function fromData(array $data): self
    {
        $instance = new static;
        $instance->rawData = $data;
        $instance->handleData();

        return $instance;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, string $value): void
    {
        $this->rawData[$key] = $value;
    }

    public function addDefault(string $key, string $value): bool
    {
        if (isset($this->rawData[$key])) {
            return false;
        }

        $this->set($key, $value);

        return true;
    }

    private function handleData()
    {
        $this->beforeValidate();
        $this->data = $this->validatedData();
        $this->afterValidate();
    }

    protected function validatedData(): array
    {
        return Validator::make($this->rawData, $this->rules())->validate();
    }

    abstract protected function rules(): array;
    protected function beforeValidate()
    {
    }

    protected function afterValidate()
    {
    }
}
