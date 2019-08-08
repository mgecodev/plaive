@extends('layouts.master')

@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="overviews" class="section wb">
                    <div class="container">
                        <h2 class="title-1 m-b-25">학생을 선택해주세요</h2>
                        <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                        <thead>
                        <tr>
                        <th>
                            <label class="au-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Created date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <label class="au-checkbox">
                                        <input type="checkbox" id="{{ $student->id }}" value="{{ $student->id }}">
                                        <span class="au-checkmark"></span>
                                        </label>
                                    </td>
                                    <td>{{ $student->Name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        </div>
                        <div class="user-data__footer">
                            <input type="submit" name="submit" id="submit" class="au-btn au-btn-load" value="초대하기"></button>
                        </div>
                    </div><!-- end container -->
                </div><!-- end section -->
            </div>
        </div>
    </div>
</div>


@endsection

