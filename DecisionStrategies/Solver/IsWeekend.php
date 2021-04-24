<?php

namespace DecisionStrategies\Solver;

/**
 * Принятие решения на основе того, выходной ли день сейчас.
 * По сути это односложный (bool) ответ на вопрос "сейчас выходной?"
 */
class IsWeekend extends SolverAbstract
{
    public function doSolve($externalData)
    {
       // Например, здесь может быть обращение к календарю
       return false; // день, допустим, рабочий
    }
}
