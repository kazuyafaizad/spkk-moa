<?php

namespace App\Actions;

use App\Models\PublicAnnouncement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Matcher\Any;
use Illuminate\Http\UploadedFile;

class EditAnnouncement
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
            'content' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateRecipeLeftover');


        $PublicAnnouncement = (new PublicAnnouncement);

        if (isset($input['image'])) {
            $file = $input['image'];
            $filename = date('YmdHi') . $file->getClientOriginalName();
            // Store the file in the 'public' disk (you can configure other disks if needed)
            $file->storeAs('public/Image', $filename);

            // Update the model's image attribute with the stored file path
            $PublicAnnouncement->image = 'storage/Image/' . $filename;

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

        $PublicAnnouncement->title = $input['title'];
        $PublicAnnouncement->content = $input['content'];
        $PublicAnnouncement->status = 1;
        $PublicAnnouncement->created_by = auth()->user()->id;

        $PublicAnnouncement->where('id', $request->id)->update([
            'title' => $PublicAnnouncement->title,
            'content' => $PublicAnnouncement->content,
            'status' => $PublicAnnouncement->status,
            'created_by' => $PublicAnnouncement->created_by,
            'image' => $PublicAnnouncement->image, // If you want to update the image as well
        ]);
    }
}
