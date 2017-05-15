<?php
namespace MongoCli\Query;

use MongoCli\Database\Operator\Select;
use MongoCli\Database\Operator\From;
use MongoCli\Database\Operator\Where;
use MongoCli\Database\Operator\Offset;
use MongoCli\Database\Operator\Limit;
use MongoCli\Database\Operator\OrderBy;
use MongoCli\Database\MongoClient;
/**
 * Class QueryBuilder
 *
 * @package MongoCli\Query
 */
class QueryBuilder
{
    /**
     * @var Answer
     */
    public $answer;

    /**
     * @param $parts, $config
     */
    public function __construct($parts, $config)
    {
        foreach($parts as $key => $value){
            $property = $value;
            $class = "MongoCli\Database\Operator\\".str_replace(' ', '', ucwords(strtolower($key)));
            $operator = new $class($value);
            $property = $operator->change();
            $this->answer[$key] = $property;
        }
        new MongoClient($this->answer, $config);
    }
}
