<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USER_ID = 1;

    /**
     * Validation errors test method
     *
     * @param string $uri
     * @param string $method
     * @param array $data
     * @param array $assertErrors
     * @return void
     */
    protected function validationErrorsTest(string $uri, string $method, array $data, array $assertErrors, mixed $actingAs = null): void
    {
        if($actingAs){
            $response = $this->actingAs($actingAs)->{$method}($uri, $data);
        }else{
            $response = $this->{$method}($uri, $data);
        }

        $response->assertSessionHasErrors(array_keys($assertErrors));

        $errors = session('errors');

        foreach ($assertErrors as $field => $assertError) {
            foreach ($assertError as $assertErrorMessage) {
                $this->assertContains($assertErrorMessage, $errors->get($field));
            }
        }

        $response->assertStatus(302);
    }


    /**
     * Returns authenticated user
     */
    protected function getUser(int $id = null): ?Authenticatable
    {
        auth()->loginUsingId($id ?? self::USER_ID);

        return auth()->user();
    }
}
