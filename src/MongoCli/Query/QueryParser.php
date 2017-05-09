<?php
namespace MongoCli\Query;

/**
 * Class QueryParser
 */
class QueryParser
{
    /**
     * @var Pattern
     */
    public $pattern;

    /**
     * @var Condition
     */
    public $condition;

    /**
     * @var Operators
     */
    public $operators = array(
            'select'  =>  '(select)(.+)',
            'from'    =>  '(from)(.+)',
            'where'   =>  '(where)(.+)',
            'order by'=>  '(order by)(.+)',
            'offset'  =>  '(offset)(\s*\d+\s*)',
            'limit'   =>  '(limit)(\s*\d+\s*)',
          );
    /**
     * @var Parts
     */
    public $parts = array(
                'select' => '',
                'from' => '',
                'where' => '',
                'order by' => '',
                'offset' => '',
                'limit' => '',
              );

    /**
     * @param string $querySQL
     */
    public function __construct($querySQL)
    {
        $subject = $querySQL;
        $this->pattern = $this->buildPattern($subject);
        preg_match($this->pattern, $subject, $matches);
        $parts = $this->getParts($matches);
    }

    /*
     * @return Pattern
     */
    public function buildPattern($subject)
    {
        $pattern = '';
        foreach ($this->operators as $key => $value) {
            $operator = '/'.$key.'/i';
            if (preg_match_all($operator, $subject)) {
                $pattern .= $value;
            }
        }
        $pattern = '/'.$pattern.'/i';
        return $pattern;
    }

    /*
     * @return Parts
     */
    public function getParts(array $matches)
    {
        foreach ($matches as $key => $value) {
            if ($key <> 0) {
                if ($key % 2) {
                    $part = strtolower(trim($matches[$key+1]));
                    $this->parts[strtolower($value)] = $part;
                }
            }
        }
        return $this->parts;
    }
}
