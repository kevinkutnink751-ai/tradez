<!-- Modal for Editing Subscriber -->
<div class="modal fade" id="editModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Account Details ({{ $item['login'] }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update.acnt.details') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Active" {{ $item['status'] == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Expired" {{ $item['status'] == 'Expired' ? 'selected' : '' }}>Expired</option>
                            <option value="Pending" {{ $item['status'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="CREDENTIALS_VERIFIED" {{ $item['status'] == 'CREDENTIALS_VERIFIED' ? 'selected' : '' }}>Credentials Verified</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control" 
                            value="{{ $item['start_date'] ? \Carbon\Carbon::parse($item['start_date'])->format('Y-m-d\TH:i') : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="datetime-local" name="end_date" class="form-control" 
                            value="{{ $item['end_date'] ? \Carbon\Carbon::parse($item['end_date'])->format('Y-m-d\TH:i') : '' }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
