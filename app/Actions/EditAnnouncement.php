<?php

namespace App\Actions;

use App\Models\PublicAnnouncement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'status' => ['required'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateRecipeLeftover');

        $publicAnnouncement = (new PublicAnnouncement)->find($request->id);

        $updateData = [
            'title' => $input['title'] ?? $publicAnnouncement->title,
            'content' => $input['content'] ?? $publicAnnouncement->content,
            'status' => $input['status'] ?? $publicAnnouncement->status,
        ];

        if (isset($input['image']) && $request->hasFile('image')) {

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
            Storage::disk('sftp')->delete($remotePath.$publicAnnouncement->image);
            //Upload File to external server
            Storage::disk('sftp')->put($remotePath, fopen($request->file('image'), 'r+'));

            $updateData['image'] = $filenametostore;

        }

        $publicAnnouncement->update($updateData);
    }
}
