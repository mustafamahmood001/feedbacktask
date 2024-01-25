<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ProductFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class productFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
       
        $query = ProductFeedback::sortable();
    
            // Check if there is a search query
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('id', 'LIKE', '%' . $search . '%')
                    ->orWhere('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%')
                    ->orWhere('feed_back', 'LIKE', '%' . $search . '%')
                    ->orWhere('feature_request', 'LIKE', '%' . $search . '%')
                    ->orWhere('vote_count', 'LIKE', '%' . $search . '%');
            }
    
            $product = $query->paginate();
        return view('productfeedbacks.indexproduct', compact('product'));
    }
   
    // index user
    public function indexUser(Request $request)
    {
        $comment = Comment::all();
    
        $query = ProductFeedback::sortable();
    
        // Check if there is a search query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('id', 'LIKE', '%' . $search . '%')
                    ->orWhere('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%')
                    ->orWhere('feed_back', 'LIKE', '%' . $search . '%')
                    ->orWhere('feature_request', 'LIKE', '%' . $search . '%')
                    ->orWhere('vote_count', 'LIKE', '%' . $search . '%');
            });
        }
    
        $product = $query->paginate(1);
        return view('welcome', compact('product', 'comment'));
    }
    

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productfeedbacks.createproduct');

    }

    /**
     * Store a newly created resource in storage.
     */

    // Other methods...

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'feed_back' => 'required|string',
            'feature_request' => 'required|string',
            'vote_count' => 'nullable|integer', // Allow null for vote_count
        ]);
    
        // If the vote_count input is disabled or not present, set it to null
        $voteCount = $request->has('vote_count') ? $request->input('vote_count') : null;
    
        // Create a new product feedback entry
        ProductFeedback::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'feed_back' => $request->input('feed_back'),
            'feature_request' => $request->input('feature_request'),
            'vote_count' => $voteCount,
            'user_id' => auth()->id(), // Assuming the user is authenticated
        ]);
    
        // Redirect back with a success message
        return redirect()->route('product.index')->with('message', 'Product feedback submitted successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=ProductFeedback::find($id);
        return view('productfeedbacks.editproduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the form data
    $request->validate([
        'title' => 'required|string',
        'category' => 'required|string',
        'feed_back' => 'required|string',
        'feature_request' => 'required|string',
    ]);

    // Find the product feedback entry by ID
    $product = ProductFeedback::find($id);

    // Check if the product feedback entry exists
    if (!$product) {
        return redirect()->route('product.index')->with('error', 'Product feedback not found');
    }

    // Update the product feedback entry with the new data
    $product->update([
        'title' => $request->input('title'),
        'category' => $request->input('category'),
        'feed_back' => $request->input('feed_back'),
        'feature_request' => $request->input('feature_request'),
    ]);

    // Redirect back with a success message
    return redirect()->route('product.index')->with('message', 'Product feedback updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = ProductFeedback::find($id);

        // Delete the user
        $product->delete();
    
        return redirect()->route('product.index')->with('message', 'User deleted successfully');
    }


// vote content
    public function vote(Request $request, $type, $productId)
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            return redirect()->back()->with('error', 'You must be logged in to vote.');
        }

        // Validate the vote type
        if (!in_array($type, ['good', 'bad'])) {
            return redirect()->back()->with('error', 'Invalid vote type.');
        }

        // Find the product feedback entry by ID
        $product = ProductFeedback::find($productId);

        // Check if the product feedback entry exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product feedback not found');
        }

        // Update the vote count based on the type
        if ($type === 'good') {
            $product->update(['vote_count' => $product->vote_count + 1]);
        } else {
            $product->update(['vote_count' => $product->vote_count - 1]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Vote submitted successfully!');
    }

    public function comment(Request $request)
    {
        // Validate the form data
        $request->validate([
            'product_id' => 'required|exists:product_feedback,id',
            'comment' => 'required|string',
        ]);
    
        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $request->input('product_id'),
            'comment' => $request->input('comment'),
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('message', 'Comment added successfully!');
    }
}