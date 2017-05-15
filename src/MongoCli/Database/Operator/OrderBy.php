<?php
namespace MongoCli\Database\Operator;

/**
 * Class OrderBy
 *
 * @package MongoCli\Database\Operator
 */
class OrderBy
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
     * @return array
     */
    public function change()
    {
        $patern = '/([a-z0-9_-]+)\s*(ASC|DESC)*/i';
        preg_match_all($patern, $this->query, $matches);
        $subject = $matches[1];
        $property = $matches[2];
        $this->answer = array();
        foreach ($matches[0] as $key => $value){
            if ($property[$key] == 'asc' || $property[$key] == '') {
                $this->answer[$subject[$key]] =  1;
            }
            if ($property[$key] == 'desc') { $this->answer[$subject[$key]] = -1; 
            }
        }
        return $this->answer;
    }
}
