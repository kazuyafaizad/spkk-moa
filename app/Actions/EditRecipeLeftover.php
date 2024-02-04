<?php

namespace App\Actions;

use App\Models\PublicRecipeLeftover;
use Illuminate\Support\Facades\Validator;

class EditRecipeLeftover
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function __invoke($request): void
    {
        $input = Validator::make($request->all(), [
            'id' => 'required',
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ], [
            'title.required' => 'Sila masukkan tajuk',
            'title.max' => 'Tajuk tidak boleh melebihi 255 aksara.',
            'description.required' => 'Sila masukkan Keterangan',
            'image.mimes' => 'Imej mestilah dalam format JPG, JPEG, atau PNG.',
            'image.max' => 'Imej tidak boleh melebihi 1024 kilobytes.',
        ])->validateWithBag('updateRecipeLeftover');

        $PublicRecipeLeftover = (new PublicRecipeLeftover)->find($request->id);

        if (isset($input['image'])) {
            $file = $input['image'];
            $filename = date('YmdHi').$file->getClientOriginalName();

            $file->storeAs('public/Image', $filename);

            $PublicRecipeLeftover->image = 'storage/Image/'.$filename;
        }

        $PublicRecipeLeftover->title = $input['title'];
        $PublicRecipeLeftover->description = $input['description'];
        $PublicRecipeLeftover->status = $input['status'];

        $updateData = [
            'title' => $PublicRecipeLeftover->title,
            'description' => $PublicRecipeLeftover->description,
            'status' => $PublicRecipeLeftover->status,
        ];

        // Check if the image is provided in the request
        if (isset($input['image'])) {
            $updateData['image'] = $PublicRecipeLeftover->image;
        }

        $PublicRecipeLeftover->update($updateData);
    }
}
