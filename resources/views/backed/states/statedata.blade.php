<table class="table">
    <thead class="thead-light">
        <tr>
            <th>
                <label class="checkboxs">
                    <input type="checkbox" id="select-all" value="">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>State Name</th>
            <th>Created On</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($states as $state)
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox" class="select-row" name="state_id[]" value="{{ $state->id }}" onclick="return deleteMultiple({{ $state->id; }})">
                        <span class="checkmarks"></span>
                              <div class="card-trash">
                        <button type="submit" class="btn" ><i class="fa fa-trash" title="Delete Amenities" style="top:1px;left:30px"></i></button>
                    </div>
                    </label>
                </td>
                <td>{{ $state->name  }}</td>
                <td>{{ $state->created_at ? $state->created_at->format('d M, Y') : '-' }}</td>
                <td>
                    @if ($state->status == 1)
                        <span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10">
                            Active
                        </span>
                    @else
                        <span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10">
                            Inactive
                        </span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        @if ($state->status == 1)
                            <a data-status="0" data-id="{{ $state->id }}" data-msg="Are you sure you want to deactivate this state?"  class="me-2 p-2 mb-0 statusChange" href="javascript:void(0)">
                                <i class="ti ti-lock-cancel" title="Deactivate State"></i>
                            </a>
                        @else
                            <a data-status="1" data-id="{{ $state->id }}" data-msg="Are you sure you want to activate this state?"  class="me-2 p-2 mb-0 statusChange" href="javascript:void(0)" >
                                <i class="ti ti-check" title="Activate State"></i>
                            </a>
                        @endif

                        <a class="me-2 p-2 mb-0" onclick="editAmenity({{ $state->id }})" title="Edit State">
                            <i class="ti ti-edit"></i>
                        </a>
                        <a data-status="2" data-id="{{ $state->id }}" data-msg="Are you sure you want to delete this state?"  class="p-2 mb-0 statusChange" title="Delete state">
                            <i class="ti ti-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No states found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination & Page Size Selector -->
<div class="d-flex justify-content-between align-items-center mt-3">
    <select class="form-select form-select-sm w-auto" id="getPaging">
        <option value="10" @if(request('paging') == 10) selected @endif>10</option>
        <option value="20" @if(request('paging') == 20) selected @endif>20</option>
        <option value="30" @if(request('paging') == 30) selected @endif>30</option>
    </select>
    <div class="paginglinks">
        {{ $states->links() }}
    </div>
</div>
