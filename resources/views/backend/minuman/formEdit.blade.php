@extends('backend.layouts.main')

@section('minuman')
    <div class="container-xl">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Minuman</h4>
                    </div>
                    <div class="card-body">
                        {{-- Menampilkan pesan kesalahan --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form edit minuman --}}
                        <form action="{{ route('admin.drink.prosesEdit', $drink->id_drink) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="Drink_Name">Nama Minuman</label>
                                <input type="text" name="Drink_Name" id="Drink_Name" class="form-control @error('Drink_Name') is-invalid @enderror" value="{{ old('Drink_Name', $drink->Drink_Name) }}" placeholder="Masukkan nama minuman" required>
                                @error('Drink_Name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Qty">Jumlah</label>
                                <input type="number" name="Qty" id="Qty" class="form-control @error('Qty') is-invalid @enderror" value="{{ old('Qty', $drink->Qty) }}" placeholder="Masukkan jumlah" required>
                                @error('Qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Price">Harga</label>
                                <input type="number" name="Price" id="Price" class="form-control @error('Price') is-invalid @enderror" value="{{ old('Price', $drink->Price) }}" placeholder="Masukkan harga" step="0.01" required>
                                @error('Price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Description">Deskripsi</label>
                                <textarea name="Description" id="Description" class="form-control @error('Description') is-invalid @enderror" rows="3" placeholder="Masukkan deskripsi" required>{{ old('Description', $drink->Description) }}</textarea>
                                @error('Description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Image">Gambar</label>
                                <input type="file" name="Image" id="Image" class="form-control-file @error('Image') is-invalid @enderror" accept="image/*">
                                @if($drink->Image)
                                    <img id="preview" src="{{ asset('storage/images/' . $drink->Image) }}" alt="Preview" style="display:block; max-width: 200px; margin-top: 10px;">
                                @endif
                                @error('Image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.drink.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('Image').addEventListener('change', function() {
            tampilkanPreview(this, 'preview');
        });

        function tampilkanPreview(input, idPreview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(idPreview).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
