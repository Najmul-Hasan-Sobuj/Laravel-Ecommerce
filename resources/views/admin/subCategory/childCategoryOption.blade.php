<option></option>
@foreach ($childCategories as $childCategorie)
    <option value="{{ $childCategorie->id }}">{{ $childCategorie->child_category_name }}</option>
@endforeach
