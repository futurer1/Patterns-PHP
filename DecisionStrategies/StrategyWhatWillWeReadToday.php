<?php

namespace DecisionStrategies;

use DecisionStrategies\Solver\IsWeekend; // выходной ли день
use DecisionStrategies\Solver\NeedToCook; // нужно ли готовить еду сейчас
use DecisionStrategies\Solver\GoodWeather; // хорошая ли погода сегодня
use DecisionStrategies\Decision\MyFavoriteBookDecision; // конкретное решение какую книгу взять с полки

/**
 * Деревовидная стратегия принятия решений по поводу того, что мы будем читать сегодня
 */
class StrategyWhatWillWeReadToday extends StrategyAbstract
{
    /**
     * Названия книг
     */
    CONST BOOK1 = 'Книга, которую я читаю по выходным, когда не нужно готовить';
    CONST BOOK2 = 'Книга как приготовить шашлык';
    CONST BOOK3 = 'Книга как сварить дома борщ';
    CONST BOOK4 = 'Книга, которую я читаю по работе, когда на улице светит солнце';
    CONST BOOK5 = 'Книга, как сварить простой суп по быстрому';
    CONST BOOK6 = 'Книга, которую я читаю по работе, когда на улице пасмурно и не нужно готовить';

   /**
     * Здесь конкретная реализация дерева стратегии принятия решений
     */
    protected function build()
    {
        $strategySolvers =
            // Выходной день?
            new IsWeekend(
                // да, выходной
                // Нужно готовить?
                new NeedToCook(
                    // да, нужно готовить
                    // Хорошая погода?
                    new GoodWeather(
                        // да, погода хорошая
                        new MyFavoriteBookDecision(self::BOOK2),
                        // нет, погода плохая
                        new MyFavoriteBookDecision(self::BOOK3)
                    )
                    // нет, готовить не нужно
                    new MyFavoriteBookDecision(self::BOOK1)
                ),

                // нет, не выходной
                // Хорошая погода?
                new GoodWeather(
                    // да, погода хорошая
                    new MyFavoriteBookDecision(self::BOOK4),
                    // нет, погода плохая
                    // Нужно готовить?
                    new NeedToCook(
                          // да, нужно готовить
                          new MyFavoriteBookDecision(self::BOOK5),
                          // нет, готовить не нужно
                          new MyFavoriteBookDecision(self::BOOK6)
                    )
                )
        );
        $this->setStrategySolvers($strategySolvers);
    }
}
