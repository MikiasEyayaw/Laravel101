<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobApplicationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class ListingController extends Controller
{
    // public function index()
    // {
    //     return view('listings.index', [
    //         'heading' => 'Latest Listings',
    //         'listings' => Listing::latest()->filter(request(['tag', 'search']))->Paginate(6)
    //     ]);
    // }
    //vue version
    public function index()
    {
        $query = Listing::query();

        if (request('keywords')) {
            $query->where('title', 'like', '%' . request('keywords') . '%')
                ->orWhere('description', 'like', '%' . request('keywords') . '%')
                ->orWhere('company', 'like', '%' . request('keywords') . '%');
        }

        $listings = $query->latest()->paginate(6)->withQueryString();

        return Inertia::render('Listings/Index', [
            'listings' => $listings->items(),
            'pagination' => [
                'current_page' => $listings->currentPage(),
                'last_page' => $listings->lastPage(),
            ],
            'filters' => request()->only(['keywords'])
        ]);
    }
    //show show Form
    // public function show(Listing $listing)
    // {
    //     return view('listings.show', [
    //         'listing' => $listing
    //     ]);
    // }

    public function show(Listing $listing)
    {
        return Inertia::render('Listings/Show', [
            'listing' => $listing,
            'filters' => request()->only(['keywords'])
        ]);
    }
    //show create Form
    // public function create()
    // {
    //     return view('listings.create');
    // }

    public function create()
    {
        return Inertia::render('Listings/Create');
    }
    //Store Listing Data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = Auth::id();
        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created sucessfully');
    }
    //show Edit form
    // public function edit(Listing $listing)
    // {
    //     return view('listings.edit', ['listing' => $listing]);
    // }

    public function edit(Listing $listing)
    {
        return Inertia::render('Listings/Edit', [
            'listing' => $listing
        ]);
    }

    //Update Listing data
    public function update(Request $request, Listing $listing)
    {
        // make sure logged in user is owner
        if ($listing->user_id != Auth::id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required',],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);

        return back()->with('message', 'Listing Updated sucessfully');
    }

    //Delete Listing
    public function destroy(Listing $listing)
    {
        // make sure logged in user is owner
        if ($listing->user_id != Auth::id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    //Manage Listings
    // public function manage()
    // {
    //     return view('listings.manage', ['listings' => Auth::user()->listings]);
    // }

    public function manage()
    {
        return Inertia::render('Listings/Manage', [
            'listings' => Auth::user()->listings
        ]);
    }
    public function apply(Request $request, Listing $listing)
    {
        Log::info('Apply method started for listing ID: ' . $listing->id);

        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // If validation fails
        if ($validator->fails()) {
            Log::error('Application validation failed', $validator->errors()->toArray());

            return back()->withErrors($validator)->withInput();
        }

        $formFields = $validator->validated();

        $cvPath = null;

        // Store CV if uploaded
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'private');
            Log::info('CV stored at: ' . $cvPath);
        }

        try {

            // Send email
            Mail::to($listing->email)
                ->send(new JobApplicationMail($formFields, $listing, $cvPath));

            Log::info('Application email sent to: ' . $listing->email);

            return redirect('/listings/' . $listing->id)
                ->with('success', 'Your application has been sent!');
        } catch (\Exception $e) {

            Log::error('Mail sending failed: ' . $e->getMessage());

            return back()->with('error', 'Mail failed: ' . $e->getMessage());
        }
    }
}
