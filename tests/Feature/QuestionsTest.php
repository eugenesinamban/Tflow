<?php

namespace Tests\Feature;

use App\Field;
use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function question() {
        return factory(Question::class)->create();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function user()
    {
        return factory(User::class)->create();
    }

    /** @test **/
    public function a_guest_cannot_view_questions()
    {

        $question = $this->question();

        $response = $this->get('/questions');

        $this->assertGuest();

        $response = $this->get('/questions/' . $question->id);

        $this->assertGuest();

    }

    /** @test **/
    public function a_guest_cannot_update_questions()
    {
        $question = $this->question();

        $response = $this->get('/questions/' . $question->id);

        $this->assertGuest();

        $response = $this->patch('/questions/' . $question->id . '/edit');

        $this->assertGuest();

        $response = $this->delete('/questions/' . $question->id);

        $this->assertGuest();

    }

    /** @test **/
    public function a_user_can_ask_a_question()
    {
        $user = $this->user();

        $response = $this->actingAs($user)->post('/questions', $this->dummyQuestion('test'));

        $response->assertRedirect('/questions');

        $this->assertDatabaseHas('questions', ['user_id' => $user->id]);

    }

    /** @test **/
    public function a_user_can_update_a_question()
    {
        $question = $this->question();
        $user = $question->user;

        $response = $this->actingAs($user)->get('/questions/' . $question->id);

        $response->assertSuccessful();

        $response = $this->actingAs($user)->call('PATCH', '/questions/' . $question->id, $this->dummyQuestion('tag, tags, tagss'));

        $response->assertRedirect('/questions/' . $question->id);

        $response = $this->actingAs($user)->delete('/questions/' . $question->id);

        $this->assertDeleted('questions', ['id' => $question->id]);

        $response->assertRedirect('/questions');

    }

    /** @test **/
    public function a_user_cannot_update_questions_he_does_not_own()
    {
        $user = $this->user();

        $question = $this->question();

        $response = $this->actingAs($user)->get('/questions/' . $question->id . '/edit');

        $response->assertForbidden();

        $response = $this->actingAs($user)->call('PATCH', '/questions/' . $question->id, $this->dummyQuestion());

        $response->assertForbidden();
    }

    /** @test **/
    public function a_user_cannot_add_blank_tags()
    {
        $user = $this->user();

        $response = $this->actingAs($user)->post('/questions', $this->dummyQuestion(',,,,,,,,,,,'));

        $this->assertDatabaseMissing('tags', ['name' => '', 'name' => ',']);

        $response = $this->actingAs($user)->post('/questions', $this->dummyQuestion(', , , , , ,, ,  , '));

        $this->assertDatabaseMissing('tags', ['name' => '', 'name' => ',']);

        $response = $this->actingAs($user)->post('/questions', $this->dummyQuestion('                     '));

        $this->assertDatabaseMissing('tags', ['name' => '', 'name' => ',']);
    }

    /**
     * @return array
     */
    private function dummyQuestion(string $tag = null): array
    {
        return [
            'question_title' => 'test',
            'question_body' => 'test',
            'tag' => $tag
        ];
    }

}
