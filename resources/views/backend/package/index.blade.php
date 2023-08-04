{{-- Edit --}}
<a href="{{ route('package.edit', ['id' => $getSingleData->id]) }}">Edit</a>

{{-- //Delete  --}}
<form action="{{ route('package.destroy', ['id' => $getSingleData->id]) }}" method="POST"
    onsubmit="return confirm('Are you sure you want to delete this package?');">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
