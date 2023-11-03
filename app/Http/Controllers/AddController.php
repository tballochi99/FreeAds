<?php

namespace App\Http\Controllers;

use App\Models\Add;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AddController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return view('adds.create');
        } else {
            return redirect('login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*' => 'required|image',
            'price' => 'required|numeric',
        ]);

        $user = Auth::user();

        $add = new Add([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $add->save();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = $photo->store('public/photos');
                $add->photos()->create(['filename' => $filename]);
            }
        }

        return redirect('/home')->with('success', 'Annonce créée avec succès.');
    }

    public function edit(Add $add)
    {
        if (Auth::user()->id === $add->user_id) {
            $photos = $add->photos;
            return view('adds.edit', compact('add', 'photos'));
        } else {
            return redirect('/home')->with('error', 'Vous ne pouvez modifier que vos propres annonces.');
        }
    }


    public function update(Request $request, Add $add)
    {
        if (Auth::user()->id === $add->user_id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'new_photos.*' => 'image',
                'price' => 'required|numeric',
            ]);

            $add->title = $request->title;
            $add->description = $request->description;
            $add->price = $request->price;
            $add->save();

            // Supprimer les photos sélectionnées
            if ($request->has('delete_photos')) {
                foreach ($request->delete_photos as $photo_id) {
                    $photo = $add->photos()->where('id', $photo_id)->first();
                    if ($photo) {
                        if (Storage::exists($photo->filename)) {
                            Storage::delete($photo->filename);
                        }
                        $photo->delete();
                    }
                }
            }

            // Ajouter de nouvelles photos
            if ($request->hasFile('new_photos')) {
                foreach ($request->file('new_photos') as $new_photo) {
                    $filename = $new_photo->store('public/photos');
                    $add->photos()->create(['filename' => $filename]);
                }
            }

            return redirect('/home')->with('success', 'Annonce mise à jour avec succès.');
        } else {
            return redirect('/home')->with('error', 'Vous ne pouvez modifier que vos propres annonces.');
        }
    }


    public function destroy($add_id)
    {
        $add = Add::query()->with('photos')->where('id', '=', $add_id)->firstOrFail();

        if (Auth::user()->id === $add->user_id) {
            foreach ($add->photos as $photo) {
                if (Storage::exists($photo->filename)) {
                    Storage::delete($photo->filename);
                }
            }
            $add->delete();
            return redirect('/home')->with('success', 'Annonce supprimée avec succès.');
        } else {
            return redirect('/home')->with('error', 'Vous ne pouvez supprimer que vos propres annonces.');
        }
    }


    public function index()
    {
        $adds = Add::with('photos')->orderBy('created_at', 'desc')->get();
        return view('home', compact('adds'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query') ?? '';
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $sort = $request->input('sort');

        $adds = Add::query();

        if ($query) {
            $adds->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            });
        }
        if ($min_price) {
            $adds->where('price', '>=', $min_price);
        }

        if ($max_price) {
            $adds->where('price', '<=', $max_price);
        }

        if ($sort === 'recent') {
            $adds = $adds->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $adds = $adds->orderBy('created_at', 'asc');
        } elseif ($sort === 'most_viewed') {
            $adds = $adds->orderBy('views', 'desc');
        }

        $adds = $adds->get();

        return view('home', compact('adds', 'query'));
    }


    public function show(Add $add)
    {
        $add->increment('views');
        return view('adds.show', compact('add'));
    }



}