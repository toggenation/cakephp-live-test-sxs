<?php

declare(strict_types=1);

namespace FastCGIParamsCreator\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use josegonzalez\Dotenv\Loader;

/**
 * MakeFastCgiParams command.
 */
class MakeFastCgiParamsCommand extends Command
{
    public string $fileName =  'app_fastcgi_params.conf';
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->setDescription(['Command to build a fastcgi_params file', 'using the contents of `config/.env`']);

        $parser->setEpilog(['Command to build a fastcgi_params file', 'using the contents of `config/.env`']);
        $parser->addOption('write', [
            'short' => 'w',
            'boolean' => true,
        ]);

        return $parser;
    }


    public static function getDescription(): string
    {
        return 'Generates a fastcgi_params.conf file for use with Nginx/php-fpm';
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        if (file_exists(CONFIG . '.env')) {
            // add this to the putenv toEnv and toServer methods if you want to overwrite
            $dotenv = new Loader([CONFIG . '.env']);

            $result = collection($dotenv->parse()->toArray())
                ->map(function ($envVarValue, $key) {
                    if (is_bool($envVarValue)) {
                        $envVarValue = $envVarValue ? 'true' : 'false';
                    }

                    return [
                        'key' => $key,
                        'value' => $envVarValue,
                        'len' => strlen($key)
                    ];
                });

            // get max len
            $max = $result->max(function ($arg) {
                return $arg['len'];
            })['len'];

            $result = $result->map(function ($value) use ($max) {
                return sprintf(
                    'fascgi_param %s%s"%s";',
                    $value['key'],
                    str_repeat(' ', $max - strlen($value['key']) + 2),
                    $value['value']
                );
            });

            $fileContents = implode("\n", $result->toArray()) . "\n\n";

            $fileName = TMP . $this->fileName;

            if (!$args->getOption('write')) {
                echo $fileContents;

                $io->info(__(
                    'Now run `{0} -w` to the command to write this output to a file in {1}',
                    $this->getName(),
                    TMP
                ));

                return static::CODE_SUCCESS;
            }

            $result = file_put_contents(
                $fileName,
                $fileContents
            );

            if ($result !== false) {
                $io->out("{$result} bytes written to {$fileName}");

                $io->warning([
                    '',
                    'The contents of this file is SECURITY SENSITIVE!!!',
                    'It could contain API keys and secrets',
                    "Remember to move $fileName to /etc/nginx/...",
                    '',
                    'Or remove it',
                ]);

                return static::CODE_SUCCESS;
            }

            return static::CODE_ERROR;
        }
    }
}
