<?php
namespace MongoCli\Database\Operator;

/**
 * Class Limit
 *
 * @package MongoCli\Database\Operator
 */
class Limit
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
     * @return srting
     */
    public function change()
    {
        $this->answer = $this->query;
        return $this->answer;
    }
}
