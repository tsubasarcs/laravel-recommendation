<?php

namespace Tsubasarcs\Recommendations;

class CodeService
{
    const DEFAULT = 1;
    protected $result;
    protected $times;
    protected $type;
    protected $length;

    public function __construct()
    {
        $this->result = [];
        $this->times = config('recommendation.default.times');
        $this->type = config('recommendation.default.type');
        $this->length = config('recommendation.default.length');
    }

    /**
     * @param int $times
     * @return array
     */
    public function generate(Int $times = 1): array
    {
        if ($this->times !== config('recommendation.default.times')) {
            return $this->genCodes();
        }

        return $this->times($times)->genCodes();
    }

    /**
     * @return array
     */
    protected function genCodes(): array
    {
        for ($i = self::DEFAULT; $i <= $this->times; $i++) {
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

        if (Recommendation::where('code', $code)->exists()) {
            return $this->genCode();
        }

        return $code;
    }

    /**
     * @param int $times
     * @return CodeService
     */
    public function times(Int $times = 1): CodeService
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param int $type
     * @return CodeService
     */
    public function type(Int $type = 1): CodeService
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $length
     * @return CodeService
     */
    public function length(Int $length = 10): CodeService
    {
        $this->length = $length;

        return $this;
    }
}