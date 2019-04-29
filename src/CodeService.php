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
    public function generate(Int $times = self::DEFAULT_TIMES): array
    {
        if ($this->times !== self::DEFAULT_TIMES) {
            return $this->genCodes();
        }

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
        $model = config('recommendation.model.name');
        $column = config('recommendation.model.code_column');

        if ($model::where($column, $code)->exists()) {
            return $this->genCode();
        }

        return $code;
    }

    /**
     * @param int $times
     * @return CodeService
     */
    public function times(Int $times = self::DEFAULT_TIMES): CodeService
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param int $type
     * @return CodeService
     */
    public function type(Int $type): CodeService
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $length
     * @return CodeService
     */
    public function length(Int $length): CodeService
    {
        $this->length = $length;

        return $this;
    }
}