@extends('layouts.master')

@section('overview')
<div class="label">
  <h2 class="subtitle">Pengguna</h2>
</div>
<div class="users">
  <table class="table">
    <thead>
      <tr>
        <th style="--width: 80px; text-align: start;">ID</th>
        <th style="--width: 150px text-align: start;">Roles</th>
        <th style="--width: 300px text-align: start;">Name</th>
        <th style="--width: calc(100% - (300px + 150px)); text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($auth as $user)
      <tr>
        <td style="--width: 80px; text-align: start;">{{ $loop->iteration }}</td>
        <td style=" --width: 150px text-align: start; text-transform: capitalize;">
          @forelse($user->roles as $role)
          {{$role->name}}
          @empty
          User
          @endforelse
        </td>
        <td style=" --width: 300px text-align: start; text-transform: capitalize;">{{ $user->name }}</td>
        <td style=" --width: calc(100% - (300px + 150px)); text-align: center;">
          <a href="/auth/edit/{{ $user->id }}" class="link btn primary">Edit</a>
          <a href="/auth/delete/{{ $user->id }}" class="link btn danger">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection