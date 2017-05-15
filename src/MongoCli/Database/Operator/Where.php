<?php
namespace MongoCli\Database\Operator;

/**
 * Class Where
 *
 * @package MongoCli\Database\Operator
 */
class Where
{
    /**
     * @var Query
     */
    public $query;

    /**
     * @var Rezult
     */
    public $rezult;

    /**
     * @var Or_existance
     */
    public $or_existance;

    /**
     * @var Symbol
    */
    public $symbol= array(
            ' => ' => ' => ',
            ' != ' => '$ne',
            ' >= ' => '$gte',
            ' > '  => '$gt',
            ' = '  => '$eq',
            ' <= ' => '$lte',
            ' < '  => '$lt',
          );

    /**
     * @param $condition
     */
    public function __construct($condition)
    {
        $this->condition = $condition;
        if ($this->emptyQuery()) {
            $this->rezult = '';
        }
        if (!$this->emptyQuery()) {
            $this->rezult = $this->parseQuery($condition);
        }
    }

    /**
     * @return array
     */
    public function parseQuery($condition)
    {
        preg_match_all('/(\w+\s*(?:=|<|>|<=|>=|!=)\s*[A-Za-z0-9]+)\s*(and|or)*/i', $condition, $matches);
        $values = $matches[1];
        $keys = $matches[2];
        $current_item = 0;
        $this->or_existance = false;
        for ($first_counter = 0; $first_counter <count($values); $first_counter++) {
            $answer[] = array();
            for ($second_counter = $first_counter; $second_counter <count($keys); $second_counter++) {
                $item = $keys[$second_counter];
                if ($item != 'or') {
                    array_push($answer[$current_item], $values[$second_counter]);
                    $first_counter++;
                }
                if ($item == 'or') {
                    array_push($answer[$current_item], $values[$second_counter]);
                    $this->or_existance = true;
                    break;
                }
            }
            $current_item++;
        }
        return $this->replaceQuery($answer);
    }

    /**
     * @return array
     */
    public function replaceQuery($conditions)
    {
        foreach ($conditions as $group_key => $group_value) {
            foreach ($group_value as $item_key => $value) {
                preg_match('/([A-Za-z_]+)\s*(=|<|>|<=|>=|!=)\s*([A-Za-z0-9]+)/', $value, $matches);
                $replaced = " $matches[2] ";
                foreach ($this->symbol as $key => $symbol) {
                    $replaced = str_replace($key, $symbol, $replaced);
                }
                $replaced_string =  array($replaced => $matches[3]);
                if (count($group_value) > 1 && $this->or_existance) {
                    $rezult[$group_key]['$and'][$item_key][$matches[1]] = $replaced_string;
                }
                if (count($group_value) > 1 && !$this->or_existance) {
                    $rezult['$and'][$item_key][$matches[1]] = $replaced_string;
                }
                if (count($group_value) == 1 && $this->or_existance) {
                    $rezult[$group_key][$matches[1]] = $replaced_string;
                }
                if (count($group_value) == 1 && !$this->or_existance) {
                    $rezult[$matches[1]] = $replaced_string;
                }
            }
        }
        return $rezult;
    }

    /**
     * @return boolean
     */
    public function emptyQuery()
    {
        if (empty($this->condition)) {
            return true;
        }
        if (!empty($this->condition)) {
            return false;
        }
    }

    /**
     * @return array
     */
    public function change()
    {
        if ($this->emptyQuery()) {
            return array();
        }
        if (!$this->emptyQuery()) {
            $answer = array();
            if ($this->or_existance) {
                $answer = array('$or' => $this->rezult);
            }
            if (!$this->or_existance) {
                $answer = $this->rezult;
            }
            return $answer;
        }
    }
}
