<?php

class ProgressionTester
{

  const PROGRESSION_ERROR = 'ERROR';
  const PROGRESSION_NONE = 'NONE';
  const PROGRESSION_ARITHMETIC = 'ARITHMETIC';
  const PROGRESSION_GEOMETHRIC = 'GEOMETHRIC';

  /**
   * ѕроверка €вл€етс€ ли арифметической прогрессией
   * @param string $testString разделенные зап€той значени€ прогрессии
   * @return boolean €вл€етс€ ли прогрессией
   */
  static function testArithmetic($testString)
  {
    $seqElements = explode(',', $testString);
    $lastElement = NULL;

    // Ёлементов должно быть более 2
    if (count($seqElements) < 3) {
      return self::PROGRESSION_ERROR;
    }

    // »скома€ разность прогрессии между первым и вторым элементом 
    // должна сохран€ть во всей прогрессии
    $commonDifference = $seqElements[1] - $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {

      // ≈сли не числовое значение, то элемент не €вл€етс€ частью последовательности
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // –азница между элементами N и N+1 не сохра€етс€, то это не арифметическа€ последовательность
      if ($seqElements[$i + 1] - $seqElements[$i] != $commonDifference) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_ARITHMETIC;
  }

  /**
   * ѕровер€ет €вл€етс€ ли геометрической прогрессией
   * @param string $testString разделенные зап€той значени€
   * @return boolean €вл€етс€ ли геометрической прогрессией
   */
  static function testGeomethric($testString)
  {
    $seqElements = explode(',', $testString);
    $lastElement = NULL;

    // Ёлементов должно быть более 2
    if (count($seqElements) < 3 || $seqElements[0] == 0) {
      return self::PROGRESSION_ERROR;
    }

    // »скома€ разность прогрессии между первым и вторым элементом 
    // должна сохран€ть во всей прогрессии
    $commonDifference = $seqElements[1] / $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {
      // ≈сли не числовое значение, то элемент не €вл€етс€ частью последовательности
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // –азница между элементами N и N+1 не сохра€етс€, то это не арифметическа€ последовательность
      if ($seqElements[$i] * $commonDifference != $seqElements[$i + 1]) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_GEOMETHRIC;
  }

}

// ћожно задать из командной строки
$inputSequeneces = $argc > 1 ?
  Array($argv[1]) :
  Array(
  '1,2,3,4,5,6,7',
  '5,10,15,20,25,30,35',
  '5,10,15,20,25,30,36',
  '6c7,1,2,3,4,5',
  'a,b,c,d,e,f',
  '2,4,8,16,32,64'
);

foreach ($inputSequeneces as $testSeq) {
  echo "\n\n" . $testSeq .
  "\nArithmetic: " . ProgressionTester::testArithmetic($testSeq) .
  "\nGeomethric: " . ProgressionTester::testGeomethric($testSeq);
}