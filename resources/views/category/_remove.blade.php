<div class="modal fade" id="category-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="categoryConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('category.destroy', $category) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryConfirm">Remove Category Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Please confirm your attempt to remove a category.</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>