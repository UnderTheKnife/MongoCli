<?php
namespace MongoCli\Database\Operator;

/**
 * Class Offset
 *
 * @package MongoCli\Database\Operator
 */
class Offset
{
    /**
     * @var Answer
     */
    public $answer;

    /**
     * @var Query
     */
    public $query;

    /**
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function change()
    {
        $this->answer = $this->query;
        return $this->answer;
    }
}
