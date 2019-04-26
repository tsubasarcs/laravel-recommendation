<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Support\Str;

class CodeService
{
    const DEFAULT = 1;
    protected $result = [];
    protected $times = 1;
    protected $type = 1;
    protected $length = 10;

    /**
     * @param int $times
     * @return array
     */
    public function generate($times = 1): array
    {
        if ($this->times !== 1) {
            return $this->genCode();
        }

        return $this->times($times)->genCode();
    }

    /**
     * @return array
     */
    protected function genCode(): array
    {
        for ($i = self::DEFAULT; $i <= $this->times; $i++) {
            array_push($this->result, [
                'type' => $this->type,
                'code' => Str::random($this->length),
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