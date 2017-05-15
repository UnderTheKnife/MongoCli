<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\Where;

class WhereTest extends TestCase
{
    /**
     * @dataProvider providerWhere
     */
    public function testChange($query, $answer)
    {
        $operator = new Where($query);
        $this->assertEquals($answer, $operator->change($query));
    }

    public function providerWhere()
    {
        return [
            [
              'age > 18',
              [
                'age' => [
                  '$gt' => 18
                ]
              ],
            ],
            [
              'age > 18 and age < 50',
              [
                '$and'=> [
                  0 => [
                    'age' => [
                      '$gt' => 18,
                    ],
                  ],
                  1 => [
                    'age' => [
                      '$lt' => 50,
                    ],
                  ],
                ]
              ],
            ],
            [
              'age > 18 and age < 50 or age = 16',
              [
                '$or' => [
                  0 => [
                    '$and'=> [
                      0 => [
                        'age' => [
                          '$gt' => 18,
                        ],
                      ],
                      1 => [
                        'age' => [
                          '$lt' => 50,
                        ],
                      ],
                    ],
                  ],
                  1 => [
                    'age' =>[
                      '$eq' => 16,
                    ],
                  ],
                ],
              ],
            ],
        ];
    }
}

