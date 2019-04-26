<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Support\Str;

class Code
{
    const DEFAULT = 1;
    protected $result = [];
    protected static $times = 1;
    protected static $type = 1;
    protected static $length = 10;

    /**
     * @param int $times
     * @return array
     */
    public static function generate($times = 1): array
    {
        if (self::$times !== 1) {
            return (new static)->genCode();
        }

        return (new static)->setTimes($times)->genCode();
    }

    /**
     * @return array
     */
    protected function genCode(): array
    {
        for ($i = self::DEFAULT; $i <= self::$times; $i++) {
            array_push($this->result, [
                'type' => self::$type,
                'code' => Str::random(self::$length),
            ]);
        }

        return $this->result;
    }

    /**
     * @param int $times
     * @return Code
     */
    public static function times($times = 1): Code
    {
        return (new static)->setTimes($times);
    }

    /**
     * @param $times
     * @return $this
     */
    protected function setTimes($times): Code
    {
        self::$times = $times;

        return $this;
    }

    /**
     * @param int $type
     * @return Code
     */
    public static function type($type = 1): Code
    {
        return (new static)->setType($type);
    }

    /**
     * @param $type
     * @return $this
     */
    protected function setType($type): Code
    {
        self::$type = $type;

        return $this;
    }

    /**
     * @param int $length
     * @return Code
     */
    public static function length($length = 10): Code
    {
        return (new static)->setLength($length);
    }

    /**
     * @param $length
     * @return $this
     */
    protected function setLength($length): Code
    {
        self::$length = $length;

        return $this;
    }
}