<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-body mb-0">
                {{ __('View Announcement') }}
            </h2>
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal">
                    <i class="bi bi-pencil me-2"></i>{{ __('Edit Announcement') }}
                </button>
                @if($announcement->status !== 'published')
                <form action="{{ route('admin.announcements.publish', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg me-2"></i>{{ __('Publish') }}
                    </button>
                </form>
                @endif
                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="fs-5 fw-semibold mb-4">{{ $announcement->title }}</h3>
                            <div class="mb-4">
                                <span class="badge {{ 
                                    $announcement->type === 'info' ? 'bg-info' : 
                                    ($announcement->type === 'warning' ? 'bg-warning' : 'bg-danger')
                                }} me-2">
                                    {{ ucfirst($announcement->type) }}
                                </span>
                                <span class="badge {{ 
                                    $announcement->status === 'published' ? 'bg-success' : 
                                    ($announcement->status === 'draft' ? 'bg-secondary' : 'bg-dark')
                                }}">
                                    {{ ucfirst($announcement->status) }}
                                </span>
                            </div>
                            <div class="mb-4">
                                {!! nl2br(e($announcement->content)) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="fs-6 fw-semibold mb-3">{{ __('Announcement Details') }}</h4>
                                    <dl class="row g-0">
                                        <dt class="col-5 text-muted">{{ __('Created By') }}</dt>
                                        <dd class="col-7">{{ $announcement->creator->name }}</dd>

                                        <dt class="col-5 text-muted">{{ __('Created At') }}</dt>
                                        <dd class="col-7">{{ $announcement->created_at->format('M d, Y H:i') }}</dd>

                                        <dt class="col-5 text-muted">{{ __('Last Updated') }}</dt>
                                        <dd class="col-7">{{ $announcement->updated_at->format('M d, Y H:i') }}</dd>

                                        @if($announcement->published_at)
                                        <dt class="col-5 text-muted">{{ __('Published At') }}</dt>
                                        <dd class="col-7">{{ $announcement->published_at->format('M d, Y H:i') }}</dd>
                                        @endif

                                        @if($announcement->archived_at)
                                        <dt class="col-5 text-muted">{{ __('Archived At') }}</dt>
                                        <dd class="col-7">{{ $announcement->archived_at->format('M d, Y H:i') }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Announcement Modal -->
    <div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $announcement->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $announcement->content }}</textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="info" {{ $announcement->type === 'info' ? 'selected' : '' }}>Information</option>
                                    <option value="warning" {{ $announcement->type === 'warning' ? 'selected' : '' }}>Warning</option>
                                    <option value="alert" {{ $announcement->type === 'alert' ? 'selected' : '' }}>Alert</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
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
</x-app-layout>