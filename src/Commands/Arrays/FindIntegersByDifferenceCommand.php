<?php

declare(strict_types=1);

namespace Commands\Arrays;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FindIntegersByDifferenceCommand extends Command
{
    /**
     * @var int
     */
    const DIFF = 2;

    /**
     * {@inheritDoc}
     */
    protected static $defaultName = 'arrays:find-integers-by-difference';

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $array = [1, 7, 5, 9, 2, 12, 3];
        $hashTable = $this->createHashTable($array);
        $counter = $this->countPairs($hashTable);
        $output->writeln("Found {$counter} pair(s)");

        return self::SUCCESS;
    }

    /**
     * @param array $hashTable
     *
     * @return int
     */
    private function countPairs(array $hashTable): int
    {
        $counter = 0;

        foreach ($hashTable as $element => $value) {
            if ($this->existsDifferenceForElement($hashTable, $element)) {
                ++$counter;
            }
        }

        return $counter;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    private function createHashTable(array $array): array
    {
        $hashTable = [];

        foreach ($array as $element) {
            $hashTable[$element] = true;
        }

        return $hashTable;
    }

    /**
     * @param array $hashTable
     * @param int   $element
     *
     * @return bool
     */
    private function existsDifferenceForElement(array $hashTable, int $element): bool
    {
        $index = $element + self::DIFF;

        return isset($hashTable[$index]);
    }
}
