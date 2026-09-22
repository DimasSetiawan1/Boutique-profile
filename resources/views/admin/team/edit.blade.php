@extends('admin.layout')

@section('title', 'Edit Team Member')
@section('topbar_title', 'Team Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Edit Team Member</h4>

        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label small fw-bold text-secondary">Full Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $team->name) }}" required placeholder="e.g. Enung Kosasih">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="role_en" class="form-label small fw-bold text-secondary">Role / Position (English) *</label>
                    <input type="text" class="form-control @error('role_en') is-invalid @enderror" id="role_en" name="role_en" value="{{ old('role_en', $team->role_en) }}" required placeholder="e.g. Creative Director">
                    @error('role_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="role_id" class="form-label small fw-bold text-secondary">Role / Position (Indonesian) *</label>
                    <input type="text" class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" value="{{ old('role_id', $team->role_id) }}" required placeholder="contoh: Direktur Kreatif">
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label small fw-bold text-secondary">Phone Number (Optional)</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $team->phone) }}" placeholder="e.g. +62 856-9317-4242">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="priority" class="form-label small fw-bold text-secondary">Display Priority *</label>
                    <input type="number" class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" value="{{ old('priority', $team->priority) }}" required min="1">
                    <div class="form-text small text-muted">Lower priority number displays first. Director = 1, Creative Director = 2.</div>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary d-block">Current Photo</label>
                    @if($team->photo_path)
                        <div class="mb-2">
                            <img src="{{ asset($team->photo_path) }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #e2e8f0;">
                        </div>
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center fw-bold text-white text-uppercase mb-2" style="width: 100px; height: 100px; font-size: 2rem;">
                            {{ collect(explode(' ', $team->name))->map(fn($n) => $n[0])->take(2)->implode('') }}
                        </div>
                    @endif

                    <label for="image" class="form-label small fw-bold text-secondary d-block">Replace Photo (Optional)</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <div class="form-text small text-muted">Upload an avatar photo (PNG, JPG, JPEG, SVG, WebP) max 2MB to replace the existing one.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="quote_en" class="form-label small fw-bold text-secondary">Creative Quote / Slogan (English) (Optional)</label>
                    <input type="text" class="form-control @error('quote_en') is-invalid @enderror" id="quote_en" name="quote_en" value="{{ old('quote_en', $team->quote_en) }}" placeholder="e.g. Idea are everywhere, I'm just transferring it.">
                    @error('quote_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="quote_id" class="form-label small fw-bold text-secondary">Creative Quote / Slogan (Indonesian) (Optional)</label>
                    <input type="text" class="form-control @error('quote_id') is-invalid @enderror" id="quote_id" name="quote_id" value="{{ old('quote_id', $team->quote_id) }}" placeholder="contoh: Ide ada di mana-mana, saya hanya menyampaikannya.">
                    @error('quote_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="description_en" class="form-label small fw-bold text-secondary">Career Description / Bio (English) (Optional)</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="4" placeholder="Brief details about career background, milestones in English...">{{ old('description_en', $team->description_en) }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="description_id" class="form-label small fw-bold text-secondary">Career Description / Bio (Indonesian) (Optional)</label>
                    <textarea class="form-control @error('description_id') is-invalid @enderror" id="description_id" name="description_id" rows="4" placeholder="Brief details about career background, milestones in Indonesian...">{{ old('description_id', $team->description_id) }}</textarea>
                    @error('description_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red);">
                    Update Member
                </button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
