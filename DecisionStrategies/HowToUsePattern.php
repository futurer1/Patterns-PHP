<?php

// Запуск паттерна
$externalData = "Любые внешние данные/DTO, которые могут понадобиться внутри Solver-ов для принятия решения по бизнес-логике;
$strategyObj = new \DecisionStrategies\StrategyWhatWillWeReadToday();
$bookName = $strategyObj->process($externalData)->getResult();
echo $bookName . PHP_EOL;

// Выведет:
// содержимое BOOK4
// 'Книга, которую я читаю по работе, когда на улице светит солнце'

?>
