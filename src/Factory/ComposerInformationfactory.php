<?php

namespace CodeHqDk\RepositoryInformation\Factory;

use CodeHqDk\LinuxBashHelper\Bash;
use CodeHqDk\LinuxBashHelper\Environment;
use CodeHqDk\LinuxBashHelper\Exception\LinuxBashHelperException;
use CodeHqDk\RepositoryInformation\Exception\RepositoryInformationException;
use CodeHqDk\RepositoryInformation\InformationBlocks\DirectDependenciesBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;
use Lcobucci\Clock\Clock;
use Lcobucci\Clock\SystemClock;

class ComposerInformationfactory implements InformationFactory
{
    public const DEFAULT_ENABLED_BLOCKS = [
        DirectDependenciesBlock::class,
    ];

    private const DO_NOT_ASK_ANY_INTERACTIVE_QUESTION = '--no-interaction';

    public function __construct(private ?Clock $clock = null)
    {
        if ($this->clock === null) {
            $this->clock = SystemClock::fromSystemTimezone();
        }
    }

    public function createBlocks(string $local_path_to_code, array $information_block_types_to_create = self::DEFAULT_ENABLED_BLOCKS): array
    {
        $this->throwExceptionIfComposerIsNotCorrectSetup();

        $this->runComposerInstallIfNeeded($local_path_to_code);

        if (!in_array(DirectDependenciesBlock::class, $information_block_types_to_create)) {
            return [];
        }

        return [
            $this->createDirectDependenciesBlock($local_path_to_code),
        ];
    }

    public function getRepositoryRequirements(): RepositoryRequirements
    {
        return new RepositoryRequirements(true, true, false, false);
    }

    public function listAvailableInformationBlocks(): array
    {
        return [
            DirectDependenciesBlock::class
        ];
    }

    private function createDirectDependenciesBlock(string $local_path_to_code): DirectDependenciesBlock
    {
        $composer = Environment::getComposerPath();
        $php = Environment::getPhpPath();

        $command_to_run = "{$php} {$composer} --working-dir={$local_path_to_code} show --direct";

        $result = Bash::runCommand($command_to_run);

        $number_of_direct_dependencies = count($result);

        $list_of_direct_dependencies = '';

        foreach ($result as $dependency) {
            $dependency = preg_replace('!\s+!', ' ', $dependency); // Strip extra spaces
            $list_of_direct_dependencies .= '<p>' . $dependency . '</p>';
        }

        return new DirectDependenciesBlock(
            'Direct dependencies',
            'Number of dierect dependencies that this repository have',
            $number_of_direct_dependencies,
            $this->clock->now()->getTimestamp(),
            $list_of_direct_dependencies,
            'This information was created by the Composer plugin'
        );
    }

    private function runComposerInstallIfNeeded(string $local_path_to_code): void
    {
        if (file_exists($local_path_to_code . DIRECTORY_SEPARATOR . 'vendor')) {
            return;
        }

        $composer = Environment::getComposerPath();
        $php = Environment::getPhpPath();

        $command_to_run = "{$php} {$composer} install --working-dir={$local_path_to_code} " . self::DO_NOT_ASK_ANY_INTERACTIVE_QUESTION;

        Bash::runCommand($command_to_run);
    }

    /**
     * @throws RepositoryInformationException
     */
    private function throwExceptionIfComposerIsNotCorrectSetup(): void {
        $composer = Environment::getComposerPath();
        $php = Environment::getPhpPath();

        $command_to_run = "{$php} {$composer} diagnose " . self::DO_NOT_ASK_ANY_INTERACTIVE_QUESTION;

        try {
            Bash::runCommand($command_to_run);
        } catch (LinuxBashHelperException $bash_helper_exception) {
            throw new RepositoryInformationException('Error composer diagonse command failed - aborting!');
        }
    }
}
