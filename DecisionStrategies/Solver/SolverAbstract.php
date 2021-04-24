<?php

namespace DecisionStrategies\Solver;

use DecisionStrategies\DecisionStrategiesException;
use DecisionStrategies\Decision\DecisionInterface;

/**
 * Абстрактный класс "принимальщика" решений
 */
abstract class SolverAbstract implements SolverInterface
{
    /**
     * следующее решение, которое нужно принять при положительном исходе (SolverInterface) ИЛИ 
     * конечный результат решения на положительный исход (DecisionInterface)
     * @var SolverInterface|DecisionInterface
     */
    private $issueTrue;

    /**
     * следующее решение, которое нужно принять при отрицательном исходе (SolverInterface) ИЛИ
     * конечный результат решения на отрицательный исход (DecisionInterface)
     * @var SolverInterface|DecisionInterface
     */
    private $issueFalse;

    /**
     * @param SolverInterface|DecisionInterface $issueTrue положительный исход
     * @param SolverInterface|DecisionInterface $issueFalse отрицательный исход
     */
    public function __construct($issueTrue = null, $issueFalse = null)
    {
        $this->issueTrue = $issueTrue;
        $this->issueFalse = $issueFalse;
    }

    /**
     * @param string $customerId
     * @return DecisionInterface
     * @throws DecisionStrategiesException
     */
    public function execute($customerId)
    {
        $solveResult = $this->doSolve($customerId);
        if (!is_bool($solveResult)) {
            throw new DecisionStrategiesException('Solver '.__CLASS__.' return wrong type '.gettype($solveResult).'! Boolean expected.');
        }
        return $solveResult ? $this->issueTrue($customerId) : $this->issueFalse($customerId);
    }

    /**
     * Реализация решения оно будет внутри класса, реализующего конкретную бизнес-логику 
     * с условиями принятия конкретного положительного или отрицательного решения
     * @param $customerId
     * @return bool
     */
    abstract public function doSolve($customerId);

    /**
     * @param $customerId
     * @return DecisionInterface|SolverInterface
     * @throws DecisionStrategiesException
     */
    protected function issueTrue($customerId)
    {
        if (!empty($this->issueTrue)) {
            if ($this->issueTrue instanceof SolverInterface) { // следующее решение в дереве решений
                return $this->issueTrue->execute($customerId);
            } else { // конечный результат решения на положительный исход (DecisionInterface)
                return $this->issueTrue;
            }
        } else {
            // дерево решений внутри стратегии не может быть без заданного исхода (положительного)
            throw new DecisionStrategiesException(__CLASS__.' is empty '.__METHOD__.' Strategy is build wrong!');
        }
    }

    /**
     * @param $customerId
     * @return DecisionInterface|SolverInterface
     * @throws DecisionStrategiesException
     */
    protected function issueFalse($customerId)
    {
        if (!empty($this->issueFalse)) {
            if ($this->issueFalse instanceof SolverInterface) { // следующее решение в дереве решений
                return $this->issueFalse->execute($customerId);
            } else { // конечный результат решения на отрицательный исход (DecisionInterface)
                return $this->issueFalse;
            }
        } else {
            // дерево решений внутри стратегии не может быть без заданного исхода (отрицательного)
            throw new DecisionStrategiesException(__CLASS__.' is empty '.__METHOD__.' Strategy is build wrong!');
        }
    }
}
