<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\Select;

class SelectTest extends TestCase
{
  /**
   * @dataProvider providerSelect
   */
  public function testChange($query, $answer)
  {
    $operator = new Select($query);
    $this->assertEquals($answer, $operator->change($query));
  }

  public function providerSelect()
  {
    return [
      [
        'name',
        [
          'name' => 1,
          '_id' => 0
        ],
      ],
      [
        'name age',
        [
          'name' => 1,
          'age' => 1,
          '_id' => 0
        ],
      ],
      [
        'first_name last_name email',
        [
          'first_name' => 1,
          'last_name' => 1,
          'email' => 1,
          '_id' => 0
        ],
      ],
    ];
  }
}

