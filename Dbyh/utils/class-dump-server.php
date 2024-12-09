<?php

namespace Dbyh\Utils;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;

/**
 * This class is used to dump variables to the console using the
 * Symfony VarDumper component.
 *
 * @since 5.1.0
 *
 * @author Niklas Eliason <niklas.eliason@decisionbyheart.com>
 */
class Dump_Server
{
    /**
     * Constructor 
     */
    public function __construct()
    {
        $cloner          = new VarCloner();
     $fallback_dumper = \in_array( \PHP_SAPI, array( 'cli', 'phpdbg' ) ) ? new CliDumper() : new HtmlDumper(); //phpcs:ignore
        $dumper          = new ServerDumper(
            'tcp://127.0.0.1:9912',
            $fallback_dumper,
            array(
            'cli'    => new CliContextProvider(),
            'source' => new SourceContextProvider(),
            )
        );

        VarDumper::setHandler(
      function ( mixed $var ) use ( $cloner, $dumper ): ?string { //phpcs:ignore
            return $dumper->dump($cloner->cloneVar($var));
            }
        );
    }
}
