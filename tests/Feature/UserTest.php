<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    private $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        $request = new Request();
        $request->initialize(['firstName' => 'test', 'lastName' => 'test', 'emailAddress' => 'test@email.com', 'password' => 'password', 'sex' => 'male', 'officeEntity' => 1]);
        $user = $this->userController->create($request);
//        $this->assertEquals(response()->json(['message' => 'the resource was successfully created', 'data' => $user], 200]), $user);
    }
}
