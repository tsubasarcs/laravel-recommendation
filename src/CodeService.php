<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Support\Carbon;

class CodeService
{
    const DEFAULT_TIMES = 1;
    protected $times;
    protected $type;
    protected $length;
    protected $prefix;
    protected $timestamp;
    protected $symbol;

    public function __construct()
    {
        $this->times = self::DEFAULT_TIMES;
        $this->type = config('recommendation.default.type');
        $this->length = config('recommendation.default.length');
        $this->prefix = config('recommendation.code_structure.prefix');
        $this->timestamp = config('recommendation.code_structure.timestamp');
        $this->symbol = config('recommendation.code_structure.symbol');
    }

    /**
     * @param int $times
     * @return array
     */
    public function generate(int $times = self::DEFAULT_TIMES): array
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
        $result = [];

        for ($i = self::DEFAULT_TIMES; $i <= $this->times; $i++) {
            array_push($result, [
                'type' => $this->type,
                'code' => $this->genCode(),
            ]);
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function genCode(): string
    {
        $structure = [
            'prefix' => $this->prefix,
            'timestamp' => $this->timestamp ? Carbon::now()->timestamp : '',
            'code' => str_random($this->length)
        ];
        $code = collect($this->formatCodeStructure($structure))->implode($this->symbol);
        $model = config('recommendation.model.name');
        $column = config('recommendation.model.code_column');

        if ($model::where($column, $code)->exists()) {
            return $this->genCode();
        }

        return $code;
    }

    /**
     * @param array $code
     * @return array
     */
    protected function formatCodeStructure(array $code): array
    {
        if (empty($code['prefix'])) {
            array_pull($code, 'prefix');
        }

        if (empty($code['timestamp'])) {
            array_pull($code, 'timestamp');
        }

        return $code;
    }

    /**
     * @param int $times
     * @return CodeService
     */
    public function times(int $times = self::DEFAULT_TIMES): CodeService
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param int $type
     * @return CodeService
     */
    public function type(int $type): CodeService
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $length
     * @return CodeService
     */
    public function length(int $length): CodeService
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @param string $prefix
     * @return CodeService
     */
    public function prefix(string $prefix): CodeService
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @param bool $bool
     * @return CodeService
     */
    public function timestamp(bool $bool): CodeService
    {
        $this->timestamp = $bool;

        return $this;
    }

    /**
     * @param string $symbol
     * @return CodeService
     */
    public function symbol(string $symbol): CodeService
    {
        $this->symbol = $symbol;

        return $this;
    }
}