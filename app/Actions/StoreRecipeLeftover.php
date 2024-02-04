<?php

namespace App\Actions;

use App\Models\PublicRecipeLeftover;
use Illuminate\Support\Facades\Validator;

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
        ], [
            'title.required' => 'Sila masukkan tajuk',
            'title.max' => 'Tajuk tidak boleh melebihi 255 aksara.',
            'description.required' => 'Sila masukkan Keterangan',
            'image.mimes' => 'Imej mestilah dalam format JPG, JPEG, atau PNG.',
            'image.max' => 'Imej tidak boleh melebihi 1024 kilobytes.',
        ])->validateWithBag('storeRecipe');

        $PublicRecipeLeftover = new PublicRecipeLeftover();

        if (isset($input['image'])) {
            $file = $input['image'];
            $filename = date('YmdHi').$file->getClientOriginalName();

            $file->storeAs('public/Image', $filename);

            $PublicRecipeLeftover->image = 'storage/Image/'.$filename;

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
