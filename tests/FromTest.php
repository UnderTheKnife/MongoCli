<?php

use PHPUnit\Framework\TestCase;
use MongoCli\Database\Operator\From;

class FromTest extends TestCase
{
  /**
   * @dataProvider providerFrom
   */
  public function testChange($query, $answer)
  {
    $operator = new From($query);
    $this->assertEquals($answer, $operator->change($query));
  }

  public function providerFrom()
  {
    return [
      [
        'name',
        'name'
      ],
      [
        'age',
        'age'
      ],
      [
        'email',
        'email'
      ],
    ];
  }
}

