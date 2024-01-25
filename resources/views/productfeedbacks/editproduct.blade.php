@include('layouts.layout_dashboard_start')

<div class="dashboardContent">
<form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}" required>
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}">
                @error('category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="feed_back" class="form-label">feed_back</label>
                <input type="text" class="form-control" id="price" name="feed_back" value="{{ $product->feed_back }}">
                @error('feed_back')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="feature_request" class="form-label">feature_request</label>
                <input type="text" class="form-control" id="feature_request" name="feature_request" value="{{ $product->feature_request }}" step="0.01">
                @error('feature_request')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        

        <button type="submit" class="btn btn-primary">Update</button>
    </form>


</div>

@include('layouts.layout_dashboard_end')
