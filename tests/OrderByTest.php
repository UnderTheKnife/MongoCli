<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\OrderBy;

class OrderByTest extends TestCase
{
  /**
   * @dataProvider providerOrderBy
   */
  public function testChange($query, $answer)
  {
    $operator = new OrderBy($query);
    $this->assertEquals($answer, $operator->change($query));
  }

  public function providerOrderBy()
  {
    return [
      [
        'name',
        [
          'name' => 1,
        ],
      ],
      [
        'name asc age desc',
        [
          'name' => 1,
          'age' => -1,
        ],
      ],
      [
        'first_name desc last_name email asc',
        [
          'first_name' => -1,
          'last_name' => 1,
          'email' => 1,
        ],
      ],
    ];
  }
}

