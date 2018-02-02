<?php
namespace tests;

use Pimple\Container as PimpleContainer;
use Germania\Random\RandomServiceProvider;
use RandomLib\Generator;

class RandomServiceProviderTest extends \PHPUnit\Framework\TestCase
{

    public function testRandomStuff()
    {
        $dic = new PimpleContainer;
        $dic->register( new RandomServiceProvider );

        $this->assertTrue( is_numeric( (string) $dic['RandomGenerator.Strength'] ));
        $this->assertTrue( is_numeric( $dic['RandomGenerator.Length'] ));

        $generator = $dic['RandomGenerator'];
        $this->assertInstanceOf( Generator::class, $generator);

        $random_callable = $dic['RandomGenerator.Callable'];
        $this->assertTrue( is_callable( $random_callable ));

        $random_str = $random_callable();
        $this->assertInternalType("string", $random_str );
    }
}
