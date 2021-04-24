<?php

namespace DecisionStrategies\Solver;

/**
 * Принятие решения на основе того, нужно ли сейчас готовить пищу. 
 * По сути это односложный (bool) ответ на вопрос "сейчас будет приготовление еды?"
 */
class NeedToCook extends SolverAbstract
{
    public function doSolve($externalData)
    {
       return true; // допустим да, необходимо готовить
    }
}
