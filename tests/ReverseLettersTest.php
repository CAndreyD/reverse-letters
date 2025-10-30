<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/reverseLettersInWords.php';

use function App\Text\reverseLettersInWords;

final class ReverseLettersTest extends TestCase
{
    public function testSimpleWords(): void
    {
        $this->assertSame('Tac', reverseLettersInWords('Cat'));
        $this->assertSame('Ьшым', reverseLettersInWords('Мышь'));
        $this->assertSame('esuOh', reverseLettersInWords('houSe'));
        $this->assertSame('кимОД', reverseLettersInWords('домИК'));
        $this->assertSame('tnAhPele', reverseLettersInWords('elEpHant'));
    }

    public function testWordsWithPunctuation(): void
    {
        $this->assertSame('tac,', reverseLettersInWords('cat,'));
        $this->assertSame('Амиз:', reverseLettersInWords('Зима:'));
        $this->assertSame("si 'dloc' won", reverseLettersInWords("is 'cold' now"));
        $this->assertSame('отэ «Кат» "отсорп"', reverseLettersInWords('это «Так» "просто"'));
    }

    public function testCompoundWords(): void
    {
        $this->assertSame('driht-trap', reverseLettersInWords('third-part'));
        $this->assertSame('nac`t', reverseLettersInWords("can`t"));
    }
}
