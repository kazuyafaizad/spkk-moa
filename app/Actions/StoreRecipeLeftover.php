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
    public function __invoke($request): void
    {
        $input = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');


        $PublicRecipeLeftover = new PublicRecipeLeftover();
        //  dd($input);
        if (isset($input['image'])) {
            $file = $input['image'];
            $filename = date('YmdHi') . $file->getClientOriginalName();
            // Store the file in the 'public' disk (you can configure other disks if needed)
            $file->storeAs('public/Image', $filename);

            // Update the model's image attribute with the stored file path
            $PublicRecipeLeftover->image = 'storage/Image/' . $filename;

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

        $PublicRecipeLeftover->title = $input['title'];
        $PublicRecipeLeftover->description = $input['description'];
        $PublicRecipeLeftover->status = 1;
        $PublicRecipeLeftover->created_by = auth()->user()->id;


        $PublicRecipeLeftover->save();
    }

}
