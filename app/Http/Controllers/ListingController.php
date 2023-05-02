<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view(
            'listings.index',
            ['listings' => Listing::latest()
            ->filter(request(['tag', 'search']))
            ->paginate(4)]
        );
    }

    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create() {
        return view('listings.create');
    }

    public function store(Request $request) {
       
        $validated = $request->validate([
            'company' => 'required|string|unique:listings,company',
            'title' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|string|email',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'mimes:jpg,bmp,png,jpeg'
        ]);
   
        if($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $validated['user_id'] = auth()->id();
        
        Listing::create($validated);
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing) {
        $validated = $request->validate([
            'company' => 'required|string',
            'title' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|string|email',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'mimes:jpg,bmp,png,jpeg'
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($validated);

        return back()->with('message', 'Listing updated successfully!');
    }
    public function destroy(Listing $listing) {
      
      $listing->delete();

      return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
