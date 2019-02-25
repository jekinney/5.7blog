<div class="modal fade" id="article-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="articleConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('article.destroy', $article) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="articleConfirm">Remove Article Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Please confirm your attempt to remove a article.</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>