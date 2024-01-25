@include('layouts.layout_dashboard_start')
<!-- Main content goes here -->

<div class="dashboardContent">
    <div class="table-responsive">
    <form action="{{ route('product.index') }}" method="GET">
        <div class="input-group mb-3">
  <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <button class="btn btn-outline-secondary" type="submit">Search</button>
  </form>
  <div class="addBrand">
        <button class="btn btn-success"><a href="{{ route('product.create') }}">Product +</a></button>
</div>
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id @sortablelink('id','↑↓')</th>
                    <th>Title @sortablelink('title','↑↓')</th>
                    <th>Category @sortablelink('category','↑↓')</th>
                    <th>Feedback @sortablelink('feed_back','↑↓')</th>
                    <th>Add feature Request @sortablelink('feature_request','↑↓')</th>
                    <th>Vote @sortablelink('vote_count','↑↓')</th>
                    <th>User @sortablelink('user_id ','↑↓')</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userAllData">
            @if(count($product) > 0)
            @foreach($product as $products)
            <tr>
            <td>{{ $products->id }}</td>
            <td>{{ $products->title }}</td>
            <td>{{ $products->category }}</td>
            <td>{{ $products->feed_back }}</td>
            <td>{{ $products->feature_request }}</td>
            <td>
    @if($products->vote_count)
        {{ $products->vote_count }}
    @else
        Null
    @endif
</td>            <td>{{ $products->user_id  }}</td>
<td>
    <button class="btn btn-warning" ><a href="{{ route('product.edit',['product'=>$products->id]) }}">Edit</a></button>
    <form action="{{ route('product.destroy', ['product' => $products->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
</form>
</td>
        </tr>
        @endforeach
          @else
          <tr>
            <td>No Data Found</td>
          </tr>
          @endif
            </tbody>
        </table>
        </div>
</div>
    </div>

    <div class="pagination-container" id="paginating">
    {{ $product->links('pagination::bootstrap-4') }}
</div>   

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

@include('layouts.layout_dashboard_end')