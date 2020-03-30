<?php

namespace ZeusVision\Common;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

abstract class ZeusTestCase extends TestCase
{
    use DatabaseTransactions;

    const APPLICATION_JSON = 'application/json';

    protected $user;
    protected $lastResponse = null;

    public function signIn($user = null)
    {
        $user = $user ?: $this->defaultUser();
        $this->be($user, 'api');
    }

    protected function defaultUser()
    {
        return config('zeus-common.user')::first();
    }

    public function get($uri, array $headers = []): TestResponse
    {
        $headers = $this->getHeaders($headers);

        return $this->response($this->getJson($uri, $headers));
    }

    public function post($uri, array $data = [], array $headers = []): TestResponse
    {
        $headers = $this->getHeaders($headers);

        return $this->response($this->postJson($uri, $data, $headers));
    }

    public function put($uri, array $data = [], array $headers = []): TestResponse
    {
        $headers = $this->getHeaders($headers);

        return $this->response($this->putJson($uri, $data, $headers));
    }

    public function delete($uri, array $data = [], array $headers = []): TestResponse
    {
        $headers = $this->getHeaders($headers);

        return $this->response($this->deleteJson($uri, $data, $headers));
    }

    protected function getHeaders(array $headers): array
    {
        return array_merge(['Accept' => self::APPLICATION_JSON, 'Content-Type' => self::APPLICATION_JSON], $headers);
    }

    public function responseContent(TestResponse $response = null): array
    {
        $response = $response ?: $this->lastResponse;

        return json_decode($response->content(), true) ?: [];
    }

    private function response(TestResponse $response)
    {
        $this->lastResponse = $response;

        return $response;
    }

    protected function dumpResponse(TestResponse $response = null): void
    {
        print_r($this->responseContent($response));
    }

    protected function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        if (isset($uses[RefreshDatabase::class])) {
            $this->refreshDatabase();
        }

        if (isset($uses[DatabaseMigrations::class])) {
            $this->runDatabaseMigrations();
        }

        if (config('zeus-common.testing.transactions') && isset($uses[DatabaseTransactions::class])) {
            $this->beginDatabaseTransaction();
        }

        if (isset($uses[WithoutMiddleware::class])) {
            $this->disableMiddlewareForAllTests();
        }

        if (isset($uses[WithoutEvents::class])) {
            $this->disableEventsForAllTests();
        }

        if (isset($uses[WithFaker::class])) {
            $this->setUpFaker();
        }

        return $uses;
    }
}
