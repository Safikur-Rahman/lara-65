@extends("admin.layout.master")
@section('title', 'Edit User')
@section('content')
<div class="container">
    {{-- @if ($user['id']=== Auth::user()->id) --}}
   <h2>User Edit</h2>
   <form action="{{ route('users.update', $user['id']) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="hidden" name="page" value="{{ $page }}">
        <div class="row g-3">
            <div class="col-md-6">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" value="{{ old('fname') ?? $user['first_name'] }}">
                @error('fname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" value="{{ old('lname') ?? $user['last_name'] }}">
                @error('lname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label>Role</label>
                <select name="role_id" class="form-select">
                    @php
                    $selected = old('role_id') ?? $user['role_id'];
                    @endphp
                    @foreach ($roles as $item)
                    <option value="{{ $item['id'] }}" @selected($selected == $item['id'])>{{$item['name']}}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="col-12">
                @if($errors->any())
                <ul class="text-danger">
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div> --}}
            <div class="col-md-12 text-end">
                <input type="submit" value="Update" class="btn btn-success">
            </div>
        </div>
    </form>
    {{-- @else
        <h5>You are not Authorized to Edit this page</h5>
    @endif    --}}
</div>
@endsection