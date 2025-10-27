<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-body mb-0">
                {{ __('Manage Announcements') }}
            </h2>
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                    <i class="bi bi-plus-lg me-2"></i>{{ __('Create Announcement') }}
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Search and Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.announcements.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search announcements..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="info" {{ request('type') === 'info' ? 'selected' : '' }}>Information</option>
                                    <option value="warning" {{ request('type') === 'warning' ? 'selected' : '' }}>Warning</option>
                                    <option value="alert" {{ request('type') === 'alert' ? 'selected' : '' }}>Alert</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-2"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Announcements List -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->title }}</td>
                                    <td>
                                        <span class="badge {{ 
                                            $announcement->type === 'info' ? 'bg-info' : 
                                            ($announcement->type === 'warning' ? 'bg-warning' : 'bg-danger')
                                        }}">
                                            {{ ucfirst($announcement->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ 
                                            $announcement->status === 'published' ? 'bg-success' : 
                                            ($announcement->status === 'draft' ? 'bg-secondary' : 'bg-dark')
                                        }}">
                                            {{ ucfirst($announcement->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $announcement->created_at->format('M d, Y H:i') }}</td>
                                    <td>{{ $announcement->updated_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.announcements.show', $announcement->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            @if($announcement->status !== 'published')
                                            <form action="{{ route('admin.announcements.publish', $announcement->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="editAnnouncementModalLabel{{ $announcement->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editAnnouncementModalLabel{{ $announcement->id }}">Edit Announcement</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="title{{ $announcement->id }}" class="form-label">Title</label>
                                                                <input type="text" name="title" id="title{{ $announcement->id }}" class="form-control" value="{{ $announcement->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="content{{ $announcement->id }}" class="form-label">Content</label>
                                                                <textarea name="content" id="content{{ $announcement->id }}" class="form-control" rows="5" required>{{ $announcement->content }}</textarea>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="type{{ $announcement->id }}" class="form-label">Type</label>
                                                                    <select name="type" id="type{{ $announcement->id }}" class="form-select" required>
                                                                        <option value="info" {{ $announcement->type === 'info' ? 'selected' : '' }}>Information</option>
                                                                        <option value="warning" {{ $announcement->type === 'warning' ? 'selected' : '' }}>Warning</option>
                                                                        <option value="alert" {{ $announcement->type === 'alert' ? 'selected' : '' }}>Alert</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="status{{ $announcement->id }}" class="form-label">Status</label>
                                                                    <select name="status" id="status{{ $announcement->id }}" class="form-select" required>
                                                                        <option value="draft" {{ $announcement->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                                                        <option value="published" {{ $announcement->status === 'published' ? 'selected' : '' }}>Published</option>
                                                                        <option value="archived" {{ $announcement->status === 'archived' ? 'selected' : '' }}>Archived</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update Announcement</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $announcements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Announcement Modal -->
    <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAnnouncementModalLabel">Create New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.announcements.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="info">Information</option>
                                    <option value="warning">Warning</option>
                                    <option value="alert">Alert</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Announcement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>