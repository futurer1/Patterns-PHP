<?php

namespace DecisionStrategies\Solver;

/**
 * Единица "Вопрос для решения", из них строится любое дерево принятия решений
 */
interface SolverInterface
{
    /**
     * Запуск принятия решения
     *
     * @param string $customerId
     * @return mixed
     */
    public function execute($customerId);
}
