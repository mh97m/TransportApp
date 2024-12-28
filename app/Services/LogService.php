<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

use function Laravel\Prompts\error;

class LogService
{
    protected string $format = 'json';

    protected string $type = 'info';

    protected string $fileName = '';

    protected string $filePath = '';

    protected array $args = [];

    public function __destruct()
    {
        $method = "{$this->format}Format";

        if (empty($this->fileName)) {
            $this->fileName = verta()->format('Y_m_d_H_i_s');
        }

        $this->filePath = storage_path("logs/{$this->fileName}.{$this->format}");

        if (! method_exists($this, $method)) {
            $errorMessage = "LogService === NOT FOUND [format = {$this->format}]";
            error($errorMessage);
            throw new Exception($errorMessage);
        }

        // try {
        $this->$method();
        // } catch (Exception $e) {
        //     $errorMessage = "LogService === ERROR: [function = {$method}] - [error-message = {$e->getMessage()}] - [error-line = {$e->getLine()}]";
        //     error($errorMessage);
        //     throw new Exception($errorMessage);
        // }
    }

    public static function new(): self
    {
        return new self;
    }

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function fileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function args(array $args): self
    {
        $this->args = $args;

        return $this;
    }

    protected function logFormat(): void
    {
        $breaker = "\n|--------------------------------------------------------------------------|\n";
        $start = "[ {$this->startTime->formatDatetime()} ]\n $breaker";
        $end =
        "\n===========================================================================|\n".
        "===========================================================================|\n".
        "===========================================================================|\n";

        $log_text = $start;
        $log_text .= '|--'.strtoupper($this->type).' ==> [ '.$this->type.' ]'.$breaker;
        foreach ($this->args as $key => $value) {
            $log_text .= '|--'.strtoupper($key).' ==> [ '.$value.' ]'.$breaker;
        }
        $log_text .= $end;

        file_put_contents(
            $this->filePath,
            $log_text.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }

    protected function jsonFormat(): void
    {
        $this->args['type'] = $this->type;
        $this->args['time'] = $this->startTime->formatDatetime();

        if (! file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }

        try {
            $fileContent = file_get_contents($this->filePath);
            $decodedContent = json_decode($fileContent, true);
        } catch (\Throwable $th) {
            $decodedContent = [];
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            file_put_contents($this->filePath, json_encode([]));
        }
        $decodedContent[] = $this->args;

        file_put_contents(
            $this->filePath,
            json_encode(
                $decodedContent,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
    }

    protected function dbFormat(): void
    {
        $table_name = strtolower($this->fileName).'_logs';

        if (! Schema::hasTable($table_name)) {
            $this->createDataBase($table_name);
        }

        DB::table($table_name)->insert(
            array_merge($this->args, [
                'created_at' => $this->startTime,
            ])
        );
    }

    private function createDataBase(string $table_name): void
    {
        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->timestamp('created_at')->useCurrent();
        });
    }
}
