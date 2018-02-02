<?php
namespace Germania\Random;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

use SecurityLib\Strength;
use RandomLib\Factory;

class RandomServiceProvider implements ServiceProviderInterface
{

    /**
     * @var integer
     */
    public $default_random_length = 256;


    /**
     * @var integer Default: 5
     */
    public $default_random_strenth = Strength::MEDIUM;



    /**
     * @param int $length   Random string length
     * @param int $strength Random generator strength
     */
    public function __construct( $length = null, $strength = null)
    {
        $this->default_random_length = $length ?: $this->default_random_length;
        $this->default_random_strenth = $strength ?: $this->default_random_strenth;
    }


    /**
     * @implements ServiceProviderInterface
     */
    public function register(Container $dic)
    {

        /**
         * @return int
         */
        $dic['RandomGenerator.Length'] = function( $dic ) {
            return $this->default_random_length;
        };

        /**
         * @return \SecurityLib\Strength
         */
        $dic['RandomGenerator.Strength'] = function( $dic ) {
            return new Strength( $this->default_random_strenth );
        };


        /**
         * @return \RandomLib\Generator
         */
        $dic['RandomGenerator'] = function( $dic ) {
            $random_string_factory = new Factory;
            $strength = $dic['RandomGenerator.Strength'];
            return  $random_string_factory->getGenerator( $strength );
        };


        /**
         * Factory for creating a Callable that returns a 256 characters random string.
         *
         * @return Callable
         */
        $dic['RandomGenerator.Callable'] = $dic->protect(function( $length = null ) use ( $dic ) {
            $length = $length ?: $dic['RandomGenerator.Length'];
            return $dic['RandomGenerator']->generateString( $length );
        });


    }
}

