<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function a_user_can_search()
    {
        $user = factory(User::class)->create();

        factory(Question::class)->create(['question_title' => 'test']);
        $this->assertEquals('test', Question::first()->question_title);

        $response = $this->actingAs($user)->get('/search', ['search' => 'test']);
        $this->assertAuthenticated();
        $response->dumpHeaders();
        $response->dumpSession();
        $response->assertRedirect('/search');
    }
}
