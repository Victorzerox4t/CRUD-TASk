<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
class drinkController extends Controller
{
    public function index(){
        $drinks = Drink::all();

        // Mengirim data ke view
        return view('backend.minuman.list', ['drink' => $drinks]);
    }


    public function tambah(){
    return view('backend.minuman.formTambah');
    }

    public function prosesTambah(Request $request){
        $validatedData = $request->validate([
            'Drink_Name' => 'required|string|max:255',
            'Qty' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'Description' => 'required|string|max:1000',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('Image')) {
            $image = $request->file('Image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $validatedData['Image'] = 'images/' . $imageName;
        }


        Drink::create([
            'Drink_Name' => $validatedData['Drink_Name'],
            'Qty' => $validatedData['Qty'],
            'Price' => $validatedData['Price'],
            'Description' => $validatedData['Description'],
            'Image' => $validatedData['Image'],
        ]);


        return redirect()->route('admin.drink.index')->with('success', 'Minuman berhasil ditambahkan');
    }

    public function edit($id){
        $drink = Drink::findOrFail($id);
        return view('backend.minuman.formEdit', compact('drink'));
    }

    public function prosesEdit(Request $request, $id){
        $validatedData = $request->validate([
            'Drink_Name' => 'required|string|max:255',
            'Qty' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'Description' => 'required|string|max:1000',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drink = Drink::findOrFail($id);

        if ($request->hasFile('Image')) {
            // Hapus gambar lama jika ada
            if ($drink->Image) {
                $oldImagePath = storage_path('app/public/images/' . $drink->Image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('Image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $validatedData['Image'] = 'images/' . $imageName;
        } else {
            // Jika tidak mengupload gambar baru, gunakan gambar lama
            $validatedData['Image'] = $drink->Image;
        }

        $drink->update($validatedData);

        return redirect()->route('admin.drink.index')->with('success', 'Minuman berhasil diperbarui');
    }

    public function hapus($id)
    {
        // Temukan minuman berdasarkan ID
        $drink = Drink::findOrFail($id);

        try {
            // Hapus gambar terkait jika ada
            if ($drink->Image) {
                $imagePath = storage_path('app/public/images/' . $drink->Image);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Hapus file gambar
                }
            }

            // Hapus entri minuman dari database
            $drink->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.drink.index')->with('success', 'Minuman berhasil dihapus');
        } catch (\Exception $e) {
            // Redirect dengan pesan gagal jika terjadi kesalahan
            return redirect()->route('admin.drink.index')->with('failed', 'Minuman tidak berhasil dihapus');
        }
    }


}
