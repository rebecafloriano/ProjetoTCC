<?php

namespace Tests;

require __DIR__.'/../../app/Http/Controllers/AuthController.php';

use PHPUnit\Framework\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    /**
     * @test
     */
    /*public function create()
    {
        $password = '123';
        $password_confirm = '123';
        $this->assertSame($password,$password_confirm);

    }*/

    public function test_check_if_user_columns_is_correct()
    {
        $user = new User;

        $expected = [
            'name',
            'avatar',
            'email',
            'password'
        ];

        $arrayCompared = array_diff($expected, $user->getFillable());


        $this->assertEquals(4, count($arrayCompared));


    }
}
