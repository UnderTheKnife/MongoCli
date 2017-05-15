<?php
namespace MongoCli\Database\Operator;

/**
 * Class From
 *
 * @package MongoCli\Database\Operator
 */
class From
{
    /**
     *@var Query
     */
    public $query;

    /**
     *@var Answer
     */
    public $answer;

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
