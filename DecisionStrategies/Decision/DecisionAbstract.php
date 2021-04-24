namespace DecisionStrategies\Decision;

/**
 * Сущность "Принятое решение"
 */
abstract class DecisionAbstract implements DecisionInterface
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
}
