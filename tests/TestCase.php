<?php

namespace Tests;

use App;
use Exception;
use Mockery as M;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertPushed($class)
    {
        $className = $this->resolveClassname($class);

        $this->assertTrue($this->isJobPushed($className), "The designated class $className has not been pushed to queue.");
    }


    protected function assertNotPushed($class)
    {
        $className = $this->resolveClassname($class);

        $this->assertFalse($this->isJobPushed($className), "The designated class $className is pushed to queue.");
    }


    private function resolveClassname($class)
    {
        return get_class(App::make($class));
    }


//    private function isJobPushed($className)
//    {
//        //retrieve current job collection in DB
//        $jobs = collect(Job::all()->toArray());
//
//        //resolve job collection
//        $newJobs = $jobs->map(function ($job) {
//            return \GuzzleHttp\json_decode($job['payload']);
//        });
//
//        return
//            $newJobs->contains(function ($job) use ($className) {
//                //make sure the command string contains className
//                return strpos($job->data->command, $className);
//            });
//    }


    /**
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = M::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }


    public function spy($class)
    {
        $mock = M::spy($class);

        $this->app->instance($class, $mock);

        return $mock;
    }


    public function tearDown()
    {
        M::close();
    }


//    protected function makeObjJson($obj)
//    {
//        return \GuzzleHttp\json_encode($obj);
//    }

    // Use this version if you're on PHP 5
    protected function disableExceptionHandling()
    {
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }
}


class PassThroughHandler extends Handler
{
    public function __construct()
    {
    }

    public function report(Exception $e)
    {
        // no-op
    }

    public function render($request, Exception $e)
    {
        throw $e;
    }
}
