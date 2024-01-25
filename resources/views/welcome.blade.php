@include('layouts.layout_start')

<div class="centered-content">
    <div class="mainContent">
        <div class="headinTable">
            <h3>Products Feedback</h3>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table custom-table">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Feedback</th>
                            <th scope="col">Feature Update Request</th>
                            <th scope="col">Vote</th>
                            <th scope="col">User</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        @foreach($product as $item)
                            <tr>
                                <!-- Table data -->
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->feed_back }}</td>
                                <td>{{ $item->feature_request }}</td>
                                <td>
                                    @auth
                                        {{-- Display the voting options for authenticated users --}}
                                        <div class="vote-buttons">
                                            <form action="{{ route('vote', ['type' => 'good', 'productId' => $item->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" style="border:solid; border-radius:36px;" class="btn btn-success"><i class="bi bi-hand-thumbs-up"></i></button>
                                            </form>
                                            <form action="{{ route('vote', ['type' => 'bad', 'productId' => $item->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" style="border:solid; border-radius:36px;" class="btn btn-danger"><i class="bi bi-hand-thumbs-down"></i></button>
                                            </form>
                                        </div>
                                    @endauth
                                    {{-- Display the vote count --}}
                                    <span>
                                        @if ($item->vote_count > 0)
                                            Good: {{ $item->vote_count }}
                                        @elseif ($item->vote_count < 0)
                                            Bad: {{ abs($item->vote_count) }}
                                        @else
                                            No Votes
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->user->image) }}" alt="User Image" class="img-fluid rounded-circle img-thumbnail" width="50">
                                    {{ $item->user->name }}
                                </td>
                            </tr>
                            <!-- Display comments and comment box for the current product -->
                            <tr>
                                <td colspan="6">
                                    <div class="comments-section">
                                        <ul class="persons">
                                            {{-- Loop through the product comments --}}
                                            @if ($item->comments)
                                                @forelse ($item->comments as $comment)
                                                <li style="padding:5%;">
                                                 Comment:{{ $comment->comment }}
                                                    <br>
                                                        <img src="{{ asset('storage/' . $comment->user->image) }}" alt="User Image" class="img-fluid rounded-circle img-thumbnail" width="30">
                                                        <strong>{{ $comment->user->name }}</strong>
                                                      
                                                        <br>
                                                        {{ $comment->created_at->format('Y-m-d') }} {{-- Displaying date only --}}
                                                    </li>
                                                @empty
                                                    <li>No comments for this product.</li>
                                                @endforelse
                                            @else
                                                <li>No comments for this product.</li>
                                            @endif
                                        </ul>

                                        <!-- Comment box (if user is authenticated) -->
                                        @auth
                                            {{-- Your comment box form goes here --}}
                                            {{-- Example form structure --}}
                                            <form action="{{ route('comments.store', ['product_id' => $item->id]) }}" method="post">
                                                @csrf
                                                <textarea name="comment" placeholder="Add your comment"></textarea>
                                                <button type="submit">Submit</button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           
        </div>
    </div>
</div>
<div class="pagination-container" id="paginating">
                {{ $product->links('pagination::bootstrap-4') }}
            </div>
@include('layouts.layout_end')
