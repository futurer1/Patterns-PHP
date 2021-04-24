<?php

namespace DecisionStrategies;

/**
 * Стратегия принятия решений состоит из дерева решений. 
 * Создается из сконфигурированных элементов 2х типов: 
 * вопрос - SolverInterface
 * конечное решение - DecisionInterface
 */
interface StrategyInterface
{
    /**
     * Запуск принятия решения по дереву стратегии
     *
     * @param string $externalData внешние данные, которые подаются внутрь каждого дерева решений
     * @return mixed
     */
    public function process($externalData);
}
