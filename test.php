<?php

class ProgressionTester
{

  const PROGRESSION_ERROR = 'ERROR';
  const PROGRESSION_NONE = 'NONE';
  const PROGRESSION_ARITHMETIC = 'ARITHMETIC';
  const PROGRESSION_GEOMETHRIC = 'GEOMETHRIC';

  /**
   * Проверка является ли арифметической прогрессией
   * @param string $testString разделенные запятой значения прогрессии
   * @return boolean является ли прогрессией
   */
  static function testArithmetic($testString)
  {
    $seqElements = explode(',', $testString);

    // Элементов должно быть более 2
    if (count($seqElements) < 3) {
      return self::PROGRESSION_ERROR;
    }

    // Искомая разность прогрессии между первым и вторым элементом 
    // должна сохранять во всей прогрессии
    $commonDifference = $seqElements[1] - $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {

      // Если не числовое значение, то элемент не является частью последовательности
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // Разница между элементами N и N+1 не сохраяется, то это не арифметическая последовательность
      if ($seqElements[$i + 1] - $seqElements[$i] != $commonDifference) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_ARITHMETIC;
  }

  /**
   * Проверяет является ли геометрической прогрессией
   * @param string $testString разделенные запятой значения
   * @return boolean является ли геометрической прогрессией
   */
  static function testGeomethric($testString)
  {
    $seqElements = explode(',', $testString);
    $lastElement = NULL;

    // Элементов должно быть более 2
    if (count($seqElements) < 3 || $seqElements[0] == 0) {
      return self::PROGRESSION_ERROR;
    }

    // Искомая разность прогрессии между первым и вторым элементом 
    // должна сохранять во всей прогрессии
    $commonDifference = $seqElements[1] / $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {
      // Если не числовое значение, то элемент не является частью последовательности
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // Разница между элементами N и N+1 не сохраяется, то это не арифметическая последовательность
      if ($seqElements[$i] * $commonDifference != $seqElements[$i + 1]) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_GEOMETHRIC;
  }

}

// Можно задать из командной строки
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