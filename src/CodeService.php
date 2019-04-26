<?php

namespace Tsubasarcs\Recommendations;

class CodeService
{
    const DEFAULT_TIMES = 1;
    protected $result;
    protected $times;
    protected $type;
    protected $length;

    public function __construct()
    {
        $this->result = [];
        $this->times = self::DEFAULT_TIMES;
        $this->type = config('recommendation.default.type');
        $this->length = config('recommendation.default.length');
    }

    /**
     * @param int $times
     * @return array
     */
    public function generate($times = 0): array
    {
        return $this->times($times)->genCodes();
    }

    /**
     * @return array
     */
    protected function genCodes(): array
    {
        for ($i = self::DEFAULT_TIMES; $i <= $this->times; $i++) {
            array_push($this->result, [
                'type' => $this->type,
                'code' => $this->genCode(),
            ]);
        }

        return $this->result;
    }

    /**
     * @return string
     */
    protected function genCode(): string
    {
        $code = str_random($this->length);
        $model = config('recommendation.prevent_repeat.model');
        $column = config('recommendation.prevent_repeat.column');

        if ($model::where($column, $code)->exists()) {
            return $this->genCode();
        }

        return $code;
    }

    /**
     * @param int $times
     * @return CodeService
     */
    public function times($times = 0): CodeService
    {
        $this->setAttribute($times, 'times');

        return $this;
    }

    /**
     * @param int $type
     * @return CodeService
     */
    public function type($type = 0): CodeService
    {
        $this->setAttribute($type, 'type');

        return $this;
    }

    /**
     * @param int $length
     * @return CodeService
     */
    public function length($length = 0): CodeService
    {
        $this->setAttribute($length, 'length');

        return $this;
    }

    /**
     * @param $variable
     * @param $attribute
     */
    protected function setAttribute($variable, $attribute): void
    {
        $this->{$attribute} = (!$variable or empty($variable) or gettype($variable) !== 'integer') ? $this->{$attribute} : $variable;
    }
}