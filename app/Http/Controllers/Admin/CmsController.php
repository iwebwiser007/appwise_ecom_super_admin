<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Page;

class CmsController extends Controller
{
    public function pages()
    {
        $pages = Page::get();
        return view('admin.cms.page', compact('pages'));
    }

    public function addEditPage($id = null)
    {
        $page = $id ? Page::find($id) : null;
        return view('admin.cms.add_edit_page', compact('page'));
    }

    public function updatePage(Request $request, $id = null)
    {

        $data = $request->validate([
            'page_title' => 'required|string|max:255',
            // 'url_key' => 'required|string|max:255|unique:cms_pages,url_key,' . ($id ?? 'NULL'),
            'html_content' => 'nullable|string',
        ]);

        $page = $id ? Page::find($id) : new Page();
        $page->page_title = $data['page_title'];
        // $page->url_key = $data['url_key'];
        $page->html_content = $data['html_content'];
        $page->save();

        return redirect('admin/pages')->with('success_message', 'Page saved successfully!');
    }

    // public function uploadImage(Request $request)
    // {
    //     if ($request->hasFile('image_file')) {
    //         $file = $request->file('image_file');

    //         $path = $file->storeAs('public/assets/images', $file->getClientOriginalName());

    //         return response()->json([
    //             'success' => true,
    //             'public_path' => 'public/storage/assets/images/' . $file->getClientOriginalName()
    //         ]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
    // }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image_file')) {
            $image_tmp = $request->file('image_file');

            $extension = $image_tmp->getClientOriginalExtension();

            // Generate a random name for the uploaded image
            $imageName = rand(111, 99999) . '.' . $extension;

            // Define the image path
            $imagePath = 'public/assets/images/' . $imageName;

            // Save the image using the Intervention package
            Image::make($image_tmp)->save($imagePath);

            return response()->json([
                'success' => true,
                'public_path' => 'https://123ecommerce.co.za/public/assets/images/' . $imageName
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
    }

    public function deletePage($id)
    {
        $pages = Page::findOrFail($id);
        return $pages;
    }

    public function changePageStatus(Request $request)
    {
        Page::where('id', $request->page_id)->update([
            "status" => $request->status
        ]);

        return response()->json(['success' => true]);
    }
}
