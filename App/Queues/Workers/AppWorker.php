<?php

namespace App\Queues\Workers;

use Aeros\Src\Classes\Worker;

class AppWorker extends Worker
{
    /**
     * This is the main worker for the application using BLOCKING operations.
     *
     * This uses Redis BLPOP which waits for jobs without polling,
     * dramatically reducing Redis load from ~20,000 to ~1 op/second per worker.
     *
     * @return void
     */
    public function handle()
    {
        app()->queue->processPipelineBlocking();
    }

    /**
     * Calls the requested worker and puts it to do its job.
     *
     * @param string|array $worker or an array workers
     * @return void
     */
    public function call(string|array $worker)
    {
        $workers = is_string($worker) ? [$worker] : $worker;

        foreach ($workers as $w) {
            if (! $this->isWorker($w)) {
                throw new \Exception(
                    sprintf('ERROR[Worker] There was a problem validating worker "%s".', $w)
                );
            }

            (new $w)->handle();
        }
    }

    /**
     * Calls all the registered workers in ./config/workers.php.
     *
     * @return void
     */
    public function callAll(array $workers = [])
    {
        $workers = ! empty($workers) ? $workers : config('workers');

        if (is_array($workers) && ! empty($workers)) {
            foreach ($workers as $worker) {
                $this->call($worker);
            }
        }
    }

    /**
     * Initiates a worker infinite loop.
     *
     * @param   Worker|string   $worker
     * @param   Callable|null   $job It can be any callable object or function
     * @param   mixed           $args Mixed arguments to pass to the callable, if provided
     * @param   integer         $sleep Sleep time
     * @return  void
     */
    public function startWorker(Worker|string $worker, ?callable $job = null, mixed $args = null, int $sleep = 200)
    {
        if (is_string($worker)) {

            if (is_subclass_of($worker, Worker::class)) {
                (new $worker)->start($job, $args, $sleep);

                return;
            }

            throw new \Exception(
                sprintf('ERROR[Worker] Worker "%s" is not valid.', $worker)
            );
        }

        $worker->start($job, $args, $sleep);
    }

    /**
     * Checks if a worker is valid.
     *
     * @param string $worker
     * @return boolean
     */
    private function isWorker(string $worker): bool
    {
        return (class_exists($worker) && get_parent_class($worker) == Worker::class);
    }
}
