<?php

namespace Tests\Feature;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;


    /** @test **/
    public function a_fake_user_will_not_be_logged_in()
    {
        $this->assertDatabaseMissing('users', ['id' => 1]);
        $response = $this->post('/reactivate', ['login' => 'eugene.sinamban@gmail.com', 'password' => 'fuminalove']);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test **/
    public function an_active_user_cannot_reactivate_his_account()
    {
        $user = $this->prepareUserDefaultsManual();
        $this->assertDatabaseHas('users', ['id' => 1]);

        $response = $this->post('/reactivate', ['login' => 'codejunkie21', 'password' => 'fuminalove']);

        $this->assertCredentials(['email' => 'eugene.sinamban@gmail.com', 'password' => 'fuminalove']);

        $this->assertAuthenticated();
    }

    /** @test **/
    public function a_user_can_reactivate_his_account()
    {
        $user = $this->prepareUserDefaultsManual();

        $this->actingAs($user)->call('DELETE', '/deactivate/' . $user->id);

        $this->assertDatabaseHas('users', ['id' => 1]);
        $this->assertSoftDeleted('users', ['id' => 1]);

        $response = $this->post('/reactivate', ['login' => 'eugene.sinamban@gmail.com', 'password' => 'fuminalove']);

        $this->assertAuthenticated();

    }

    /** @test **/
    public function a_user_can_deactivate_his_account()
    {
//        prepare defaults

        $user = $this->prepareUserDefaults();

//        commence test

        $response = $this->actingAs($user)->call('DELETE', '/deactivate/' . $user->id);


        $response->assertRedirect('/');

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        $this->assertSoftDeleted('profiles', ['user_id' => $user->id]);

        $this->assertSoftDeleted('questions', ['user_id' => $user->id]);

        $this->assertSoftDeleted('answers', ['user_id' => $user->id]);

    }

    /** @test **/
    public function a_user_can_permanently_delete_his_account()
    {
//        produce defaults

        $user = $this->prepareUserDefaults();

//        commence test

        $response = $this->actingAs($user)->delete('/deleteAccount/' . $user->id);

        $response->assertRedirect('/');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        $this->assertDatabaseMissing('profiles', ['user_id' => $user->id]);

        $this->assertDatabaseMissing('questions', ['user_id' => $user->id]);

        $this->assertDatabaseMissing('answers', ['user_id' => $user->id]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function prepareUserDefaults()
    {
        $user = factory(User::class)->create();

        $user->questions()->create(['question_title' => 'test', 'question_body' => 'test', 'tag' => 'tag']);

        $question = factory(Question::class)->create();

        $answer = new Answer();

        $answer->user()->associate($user);
        $answer->question()->associate($question);
        $answer->answer = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $answer->save();
        return $user;
    }

    /**
     * @return User
     */
    private function prepareUserDefaultsManual(): User
    {
        $user = new User();

        $user->id = 1;
        $user->name = 'eugene';
        $user->email = 'eugene.sinamban@gmail.com';
        $user->username = 'codejunkie21';
        $user->password = Hash::make('fuminalove');
        $user->course_id = 7;
        $user->field_id = 2;
        $user->year = 2;
        $user->save();
        return $user;
    }
}
