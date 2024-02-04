<?php

namespace App\Actions;

use App\Models\PublicAnnouncement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        if ($request->hasFile('image')) {

            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = 'announcement-'.$filename.'.'.$extension;

            // Determine the remote path
            $subfolder = 'announcement';
            $remotePath = 'data/spkk/'.$subfolder;
            $remotePath = $remotePath.'/'.$filenametostore;

            //Upload File to external server
            Storage::disk('sftp')->put($remotePath, fopen($request->file('image'), 'r+'));

            $PublicAnnouncement->image = $filenametostore;

        }

        $PublicAnnouncement->title = $input['title'];
        $PublicAnnouncement->content = $input['content'];
        $PublicAnnouncement->status = 1;
        $PublicAnnouncement->display_at = $input['display_at'];
        $PublicAnnouncement->created_by = auth()->user()->id;

        $PublicAnnouncement->save();
    }
}
