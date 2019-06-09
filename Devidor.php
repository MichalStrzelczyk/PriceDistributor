<?php

/**
 * Class Distributor
 */
class Distributor
{
    /**
     * Add rest beginning from first element
     */
    const STRATEGY_FROM_START = 'fromStart';

    /**
     * Add rest beginning from last element
     */
    const STRATEGY_FROM_END = 'fromEnd';

    /**
     * Add rest in random way
     */
    const STRATEGY_SHUFFLE = 'shuffle';

    /**
     * divideRest
     *
     * @param $amount
     * @param $divider
     * @param string $strategy
     *
     * @return array
     */
    static public function divideRest($amount, $divider, $strategy = 'fromStart')
    {
        $delta = (float) \bcdiv((string) $amount, (string) $divider);
        $delta = \floor($delta);
        $result = \array_fill(0, $divider, (int) $delta);

        $rest = (float) \bcmod((string) $amount, (string) $divider);
        $i = 0;
        $maxElements = \count($result);
        while ($rest > 0) {
            $index = $i % $maxElements;
            $result[$index]++;
            $rest--;
            $i++;
        }

        switch ($strategy) {
            case self::STRATEGY_FROM_START : break;
            case self::STRATEGY_FROM_END :  $result = \array_reverse($result); break;
            case self::STRATEGY_SHUFFLE : \shuffle($result); break;
            default:
                throw new \LogicException('Unsupported strategy');
        }

        return $result;
    }
}