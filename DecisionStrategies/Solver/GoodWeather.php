<?php

namespace DecisionStrategies\Solver;

/**
 * Принятие решения на основе того, хорошая ли сейчас погода. 
 * По сути это односложный (bool) ответ на вопрос "хорошая ли погода?"
 */
class GoodWeather extends SolverAbstract
{
    public function doSolve($externalData)
    {
       // Например, здесь может быть обращение к API сервиса погоды
       return true; // погода, допустим, хорошая
    }
}
