<?php

class ProgressionTester
{

  const PROGRESSION_ERROR = 'ERROR';
  const PROGRESSION_NONE = 'NONE';
  const PROGRESSION_ARITHMETIC = 'ARITHMETIC';
  const PROGRESSION_GEOMETHRIC = 'GEOMETHRIC';

  /**
   * �������� �������� �� �������������� �����������
   * @param string $testString ����������� ������� �������� ����������
   * @return boolean �������� �� �����������
   */
  static function testArithmetic($testString)
  {
    $seqElements = explode(',', $testString);
    $lastElement = NULL;

    // ��������� ������ ���� ����� 2
    if (count($seqElements) < 3) {
      return self::PROGRESSION_ERROR;
    }

    // ������� �������� ���������� ����� ������ � ������ ��������� 
    // ������ ��������� �� ���� ����������
    $commonDifference = $seqElements[1] - $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {

      // ���� �� �������� ��������, �� ������� �� �������� ������ ������������������
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // ������� ����� ���������� N � N+1 �� ����������, �� ��� �� �������������� ������������������
      if ($seqElements[$i + 1] - $seqElements[$i] != $commonDifference) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_ARITHMETIC;
  }

  /**
   * ��������� �������� �� �������������� �����������
   * @param string $testString ����������� ������� ��������
   * @return boolean �������� �� �������������� �����������
   */
  static function testGeomethric($testString)
  {
    $seqElements = explode(',', $testString);
    $lastElement = NULL;

    // ��������� ������ ���� ����� 2
    if (count($seqElements) < 3 || $seqElements[0] == 0) {
      return self::PROGRESSION_ERROR;
    }

    // ������� �������� ���������� ����� ������ � ������ ��������� 
    // ������ ��������� �� ���� ����������
    $commonDifference = $seqElements[1] / $seqElements[0];

    for ($i = 0; $i < count($seqElements) - 1; $i ++) {
      // ���� �� �������� ��������, �� ������� �� �������� ������ ������������������
      if (!is_numeric($seqElements[$i])) {
        return self::PROGRESSION_ERROR;
      }

      // ������� ����� ���������� N � N+1 �� ����������, �� ��� �� �������������� ������������������
      if ($seqElements[$i] * $commonDifference != $seqElements[$i + 1]) {
        return self::PROGRESSION_NONE;
      }
    }
    return self::PROGRESSION_GEOMETHRIC;
  }

}

// ����� ������ �� ��������� ������
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