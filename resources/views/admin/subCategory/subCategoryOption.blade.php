<option></option>
@foreach ($subCategories as $subCategorie)
    <option value="{{ $subCategorie->id }}">{{ $subCategorie->sub_category_name }}</option>
@endforeach
