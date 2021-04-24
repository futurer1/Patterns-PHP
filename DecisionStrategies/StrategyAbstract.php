<?php

namespace DecisionStrategies;

use DecisionStrategies\Decision\DecisionInterface;
use DecisionStrategies\Solver\SolverInterface;

abstract class StrategyAbstract implements StrategyInterface
{
    /**
     * @var SolverInterface
     */
    protected $strategySolvers;

    public function __construct()
    {
        $this->build();
    }

    /**
     * @param SolverInterface $strategy
     */
    protected function setStrategySolvers($strategy)
    {
        $this->strategySolvers = $strategy;
    }

    /**
     * создание дерева решений будет внутри каждой отдельной реализации стратегии
     */
    abstract protected function build();

    /**
     * @param string $externalData это не обязетельно должен быть string. 
     * Вполне это может быть объект DTO. 
     * Понадобится эта информация внутри реализации метода doSolve() SolverAbstract
     * @return DecisionInterface
     * @throws DecisionStrategiesException
     */
    public function process($externalData)
    {
        if (empty($this->strategySolvers) || !$this->strategySolvers instanceof SolverInterface) {
            throw new DecisionStrategiesException('Empty filters in strategy. First you need to build a strategy.');
        }
        return $this->strategySolvers->execute($externalData);
    }
}
