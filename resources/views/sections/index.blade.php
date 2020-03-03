@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('pages.sections') }}</div>

                    <div class="row">
                        <div class="col-md-12 mb-1 mt-3 ">
                            <div class="pull-right mr-4">
                                <a class="btn btn-success" href="{{ route('sections.create') }}"> Create</a>
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
                            <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td><img src="{{ asset('logo/'.$section->logo) }}" alt="{{ $section->name }}"
                                             class="logo-img"></td>
                                    <td>
                                        <h4>{{ $section->name }}</h4>
                                        <p>{{ $section->description }}</p>
                                    </td>
                                    <td>
                                        <ol>
                                            @foreach($section->users as $user)
                                                <li>{{$user->name}}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{ $section->created_at }}</td>
                                    <td>
                                        <a href="{{ route('sections.show',$section->id) }}">
                                            <p data-placement="top" data-toggle="tooltip" title="View">
                                                <button class="btn btn-success btn-xs" data-title="Edit"
                                                        data-toggle="modal"
                                                        data-target="#edit"><i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('sections.edit',$section->id) }}">
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <button class="btn btn-primary btn-xs" data-title="Edit"
                                                        data-toggle="modal"
                                                        data-target="#edit"><i class="fa fa-pencil"
                                                                               aria-hidden="true"></i></button>
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                                                            aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">{{ $sections->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
