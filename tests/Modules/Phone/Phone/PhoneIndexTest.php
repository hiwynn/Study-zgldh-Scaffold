<?php namespace Tests\Modules\Phone\Phone;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Modules\User\Models\User;

class PhoneIndexTest extends TestCase
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

    public function testPhoneIndexSuccessfully()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $user = factory(User::class)->create();
        $request = $this->actingAs($user, 'api');

        $response = $request->get('api/phone');
        $response->assertStatus(200);
    }

    public function testPhoneIndexWithError()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $response = $this->get('api/phone');
        $response->assertStatus(500);
    }
}
