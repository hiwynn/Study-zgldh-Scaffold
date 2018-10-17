<?php namespace Tests\Modules\Phone\Phone;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Modules\User\Models\User;

class PhoneDestroyTest extends TestCase
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

    public function testPhoneDestroySuccessfully()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $user = factory(User::class)->create();
        $request = $this->actingAs($user, 'api');

        $response = $request->delete('api/phone/{id}');
        $response->assertStatus(200);
    }

    public function testPhoneDestroyWithError()
    {
        // Reference: https://laravel.com/docs/5.5/http-tests
        $response = $this->delete('api/phone/{id}');
        $response->assertStatus(500);
    }
}
