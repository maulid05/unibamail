@extends('target.layouts.app')
@section('content')
<form action="{{ route('tempel.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table-borderred table container mt-5">
        <tbody>
                <tr>
                    <td>
                    <input class="btn btn-success btn-sm" type="file" id="" name="file" id="formfile" multiple>
                    <input class="hidden" type="hidden" id="id_surat" name="id_surat" value="{{ $id_surat->id }}" >
                    </td>
                </tr>
                <tr>
                    <td> 
                    <button class="btn btn-success btn-sm" type="submit">Upload</button>
                    </td>
                </tr>
        </tbody>
    </table>
</form>
@endsection