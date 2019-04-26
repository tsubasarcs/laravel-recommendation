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
    public function generate($times = 1): array
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
                'code' => str_random($this->length),
            ]);
        }

        return $this->result;
    }

    /**
     * @param int $times
     * @return CodeService
     */
    public function times($times = 1): CodeService
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param int $type
     * @return CodeService
     */
    public function type($type = 1): CodeService
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $length
     * @return CodeService
     */
    public function length($length = 10): CodeService
    {
        $this->length = $length;

        return $this;
    }
}