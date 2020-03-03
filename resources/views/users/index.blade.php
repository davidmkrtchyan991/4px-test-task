@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('pages.users') }}</div>

                    <div class="row">
                        <div class="col-md-12 mb-1 mt-3 ">
                            <div class="pull-right mr-4">
                                <a class="btn btn-success" href="{{ route('users.create') }}"> Create</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('users.show',$user->id) }}">
                                                <p data-placement="top" data-toggle="tooltip" title="View">
                                                    <button class="btn btn-success btn-xs" data-title="Edit" data-toggle="modal"
                                                            data-target="#edit"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                </p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit',$user->id) }}">
                                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                    <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal"
                                                            data-target="#edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                </p>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
