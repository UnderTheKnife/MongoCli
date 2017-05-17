<?php
namespace MongoCli\Database\Operator;

/**
 * Class Select
 *
 * @package MongoCli\Database\Operator
 */
class Select
{
    /**
     * @var Query
     */
    public $query;

    /**
     * @var Answer
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
     * @return array
     */
    public function change()
    {
        if ($this->query == '*') $this->answer = '*';
        if ($this->query != '*') {
            preg_match_all('/[A-Za-z0-9_]+/', $this->query, $matches);
            $collections = $matches[0];
            foreach ($collections as $key => $value){
                $this->answer[$value] = 1;
            }
            $this->answer['_id'] = 0;
        }
        return $this->answer;
    }
}

