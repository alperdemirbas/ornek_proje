<div class="d-flex">
    <a href="{{ _route('cars.edit', ['car' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp"><i class="fas fa-pencil"></i></a>
    <form class="deleteAction" action="{{ _route('cars.destroy', ['car' => $row->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-primary shadow btn-xs sharp ms-2 deleteAction"><i class="fas fa-trash"></i></button>
    </form>
</div>