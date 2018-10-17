<?php namespace Tests\Modules\Phone\Phone;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Modules\User\Models\User;

class PhoneShowTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

//      Prepare testing database environment.
        /**
         * $this->createTestUser();
         **/
    }

    public function testPhoneShowSuccessfully()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $user = factory(User::class)->create();
        $request = $this->actingAs($user, 'api');

        $response = $request->get('api/phone/{id}');
        $response->assertStatus(200);
    }

    public function testPhoneShowWithError()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $response = $this->get('api/phone/{id}');
        $response->assertStatus(500);
    }
}
