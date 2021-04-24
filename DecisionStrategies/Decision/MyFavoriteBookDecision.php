<?php

namespace DecisionStrategies\Decision;

/**
 * Решение, являющее собой, например, название книги для прочтения
 */
class MyFavoriteBookDecision extends DecisionAbstract
{
    /**
     * @var string название книги
     */
    protected $result;
}
