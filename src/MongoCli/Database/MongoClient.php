<?php

namespace MongoCli\Database;

use MongoDB\Driver;
use MongoDB\BSON;

/**
 * Class MongoClient
 *
 * @package MongoCli\Database
 */
class MongoClient
{
    /**
     * @var Config
     */
    public $config;

    /**
     * @param $properties, $config
     */
    public function __construct($properties, $config)
    {
      print_r ($properties);
        $this->config = $config;
        if (empty($properties['select']) || empty($properties['from'])) {
            echo "Invalid syntax!\n";
        }
        if (!empty($properties['select']) && !empty($properties['from'])) {
            $this->run($properties);
        }
    }

    /**
     * @return void
     */
    public function run($properties)
    {
        if ($properties['select'] == '*') { $properties['select'] = array();
        }
        //INIT
        $mongo = new Driver\Manager($this->config['db_uri']);
        $properties['select']['_id'] = 0;
        // SELECT
        $filter =$properties['where'];
        $options = [
              'projection' =>$properties['select'],
              'sort' => $properties['order by'],
              'skip'=>$properties['offset'],
              'limit' =>$properties['limit'],
              ];

        $query = new Driver\Query($filter, $options);
        try {
            $database = $this->config['db_name'];
            $collection = $properties['from'];
            $cursor = $mongo->executeQuery($database.'.'.$collection, $query);
            $cursor = BSON\fromPHP($cursor->toArray());
            $cursor = json_decode(BSON\toJSON($cursor), true);
        } catch (Driver\Exception\Exception $e) {
            echo $e->getMessage(), "\n";
        }
        foreach($cursor as $document) {
            foreach ($document as $key => $value){
                echo $key.' : '.$value.', ';
            }
            echo ''.PHP_EOL;
        }
    }
}
