<?php

namespace App\Actions;

use App\Models\PublicAnnouncement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Matcher\Any;
use Illuminate\Http\UploadedFile;

class StoreAnnouncement
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
            'content' => ['required', 'string'],
            'display_at' => ['date_format:Y-m-d\TH:i', 'required'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('storeAnnouncement');


        $PublicAnnouncement = new PublicAnnouncement();
        //  dd($input);
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
        $PublicAnnouncement->display_at = $input['display_at'];
        $PublicAnnouncement->created_by = auth()->user()->id;


        $PublicAnnouncement->save();
    }
}
