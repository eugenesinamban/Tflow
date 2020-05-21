<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseTransactions;


    private function user() {
        return factory(User::class)->create();
    }

    /** @test **/
    public function a_user_can_update_his_profile()
    {
        $user = $this->user();

        $response = $this->actingAs($user)->call('PATCH', '/profile/' . $user->profile->id, [
           'details' => 'I am the greatest',
            'url' => 'https://github.com',
            'about_myself' => 'I am eugene and I am the best',
            'course' => 'hehehe',
            'year' => 2
        ]);

        $response->assertRedirect('/profile');
    }

    /** @test **/
    public function a_user_can_upload_a_profile_image()
    {
        $user = $this->user();
        Storage::fake('gcs');
//        Storage::fake('public');
//        Storage::disk('gcs');

        $image = UploadedFile::fake()->image('profile_image.png')->size(1500);

        $response = $this->actingAs($user)->put('/profile/' . $user->profile->id, ['profile_image' => $image]);

        $response->assertRedirect('/profile');
        Storage::disk('public')->assertExists('/profile_images/' . $image->hashName());
//        Storage::disk('gcs')->assertExists('/profile_images/' . $image->hashName());

    }
}
