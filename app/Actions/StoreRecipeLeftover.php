<?php

namespace App\Actions;

use App\Models\PublicRecipeLeftover;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Matcher\Any;
use Illuminate\Http\UploadedFile;

class StoreRecipeLeftover
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function __invoke(Any $input): void
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        $data = new PublicRecipeLeftover();

        if (isset($input['image'])) {
            $file = $input->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $data['image'] = $filename;

            // tap($this->profile_photo_path, function ($previous) use ($photo, $storagePath) {
            //     $this->forceFill([
            //         'profile_photo_path' => $photo->storePublicly(
            //             $storagePath,
            //             ['disk' => $this->profilePhotoDisk()]
            //         ),
            //     ])->save();

            //     if ($previous) {
            //         Storage::disk($this->profilePhotoDisk())->delete($previous);
            //     }
            // });
        }

        PublicRecipeLeftover::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'status' => 0
        ]);
    }

}
