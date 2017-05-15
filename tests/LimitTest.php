<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\Limit;

class LimitTest extends TestCase
{
  /**
   * @dataProvider providerLimit
   */
  public function testChange($query, $answer)
  {
    $operator = new Limit($query);
    $this->assertEquals($answer, $operator->change($query));
  }

  public function providerLimit()
  {
    return [
      [
        '1',
        1
      ],
      [
        '20',
        20
      ],
      [
        '100',
        100
      ],
    ];
  }
}

