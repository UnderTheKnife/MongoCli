<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\Offset;

class OffsetTest extends TestCase
{
  /**
   * @dataProvider providerOffset
   */
  public function testChange($query, $answer)
  {
    $operator = new Offset($query);
    $this->assertEquals($answer, $operator->change($query));
  }

  public function providerOffset()
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

