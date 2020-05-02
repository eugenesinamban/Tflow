<?php

namespace Tests\Feature;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AnswersTest extends TestCase
{
    use DatabaseTransactions;

//    public function setUp(): void
//    {
//        parent::setUp();
//
//        $this->seed(\FieldSeeder::class);
//        $this->seed(\CourseSeeder::class);
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function answer() {
        return factory(Answer::class)->create();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function question() {
        return factory(Question::class)->create();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function user() {
        return factory(User::class)->create();
    }

    /** @test **/
    public function a_user_can_answer_questions()
    {

        $question = $this->question();

        $user = $this->user();

        $response = $this->actingAs($user)
           ->withSession(['question_id' => $question->id])
           ->post('/answers/' . $question->id . '/' . $question->question_title, [
           'answer' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ]);

        $this->assertEquals('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', Answer::first()->answer);
       $response->assertRedirect();
    }

    /** @test **/
    public function a_user_cannot_answer_his_own_questions()
    {

        $question = $this->question();

        $user = $question->user;

        $response = $this->actingAs($user)
            ->withSession(['question_id' => $question->id])
            ->post('/answers/' . $question->id . '/' . $question->question_title, [
                'answer' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
            ]);

        $response->assertForbidden();
    }


    /** @test **/
    public function a_user_can_update_his_own_answer()
    {

        $answer = $this->answer();

        $question = $answer->question;

        $user = $answer->user;

        $response = $this->actingAs($user)
            ->withSession(['question_id' => $question->id])
            ->call('PATCH', '/answers/' . $answer->id, [
               'answer' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'
            ]);

        $response->assertRedirect('/questions/' . $question->id);

        $response = $this->actingAs($user)
            ->delete('/answers/' . $answer->id);

        $this->assertDeleted('answers', ['id' => $answer->id]);

        $response->assertRedirect(URL::previous());

    }

    /** @test **/
    public function a_user_cannot_update_others_answer()
    {
        $answer = $this->answer();

        $question = $this->question();

        $user = $this->user();

        $response = $this->actingAs($user)
            ->withSession(['question_id' => $question->id])
            ->call('PATCH', '/answers/' . $answer->id, [
                'answer' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'
            ]);

        $response->assertForbidden();

        $response = $this->actingAs($user)
            ->delete('/answers/' . $answer->id);

        $response->assertForbidden();
    }
}
