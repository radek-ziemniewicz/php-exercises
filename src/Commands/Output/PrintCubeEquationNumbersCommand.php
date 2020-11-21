<?php

declare(strict_types=1);

namespace Commands\Output;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PrintCubeEquationNumbersCommand extends Command
{
    protected static $defaultName = 'output:print-cube-equation-numbers';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $n = 1000;

        for ($a = 0; $a <= $n; ++$a) {
            for ($b = 0; $b <= $n; ++$b) {
                for ($c = 0; $c <= $n; ++$c) {
                    $d = pow(pow($a, 3) + pow($b, 3) - pow($c, 3), 1/3);

                    if ($a === $b || $a === $c || $a === $d || $b === $c || $b === $d || $c === $d) {
                        continue;
                    }

                    if (filter_var($d, FILTER_VALIDATE_INT)) {
                        $output->writeln("{$a}^3 + {$b}^3 = {$c}^3 + {$d}^3");

                        break;
                    }
                }
            }
        }

        return self::SUCCESS;
    }
}
