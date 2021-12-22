<?php declare(strict_types=1);

require_once '../FizzBuzz.php';
use PHPUnit\Framework\TestCase;
class FizzBuzzTest extends TestCase {

    protected $object;

    public function setUp(): void {
        // テストするオブジェクトを生成する
        $this->object = new FizzBuzz();
    }

    /**
     * FizzBuzzの検証
     * 100回ループし、一般的なFizzBuzzの要件に該当するかをテストする
     * 入力: 検証する値
     * 出力: FizzBuzzメッセージ
     */
    public function testFizzBuzz() {

        for($i = 1;$i <= 100;$i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $this->assertEquals("FizzBuzz", $this->object->kuso($i));
            } else if ($i % 3 == 0) {
                $this->assertEquals("Fizz", $this->object->kuso($i));
            } else if ($i % 5 == 0) {
                $this->assertEquals("Buzz", $this->object->kuso($i));
            } else {
                $this->assertEquals("normal", $this->object->kuso($i));
            }
        }
    }
}
?>