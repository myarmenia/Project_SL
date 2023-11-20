@extends('layouts.app')
@section('content')

    {{-- <a href="{{ route('show.all.file', ['locale' => app()->getLocale(), 'filename' => $filename]) }}">Show Doc</a><br> --}}

    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Name</th>
                    <th scope="col">patronymic</th>
                    <th scope="col">birthday</th>
                    <th scope="col">address</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Paragraph</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($fileDetails as $detail)
                    <tr id="editableRow">
                        <th scope="row">{{ $detail->id }}</th>
                        <td class="editable-cell" data-item-id="{{ $detail->id }}" data-column="surname"
                            onclick="makeEditable(this)">
                            {{ $detail->surname }}
                        </td>
                        <td class="editable-cell" data-item-id="{{ $detail->id }}" data-column="name"
                            onclick="makeEditable(this)">
                            {{ $detail->name }}
                        </td>
                        <td class="editable-cell" data-item-id="{{ $detail->id }}" data-column="patronymic"
                            onclick="makeEditable(this)">
                            {{ $detail->patronymic }}
                        </td>
                        <td class="editable-cell" data-item-id="{{ $detail->id }}" data-column="birthday"
                            onclick="makeEditable(this)">
                            {{ $detail->birthday }}
                        </td>
                        <td class="editable-cell" data-item-id="{{ $detail->id }}" data-column="address"
                            onclick="makeEditable(this)">
                            {{ $detail->address }}
                        </td>
                        <td class='d-flex justify-content-center'>
                            <form action="{{ route('details.destroy', $detail->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button style="background:none;border:none" type="submit"
                                    onclick="return confirm('Համոզվա՞ծ եք որ ցանկանում եք ջնջել այս տողը')"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg></button>
                            </form>
                        </td>
                        <td>
                            <div class="details" style="height:150px; overflow:auto">{!! $detail->paragraph !!}</div>
                        </td>
                    </tr>
                @endforeach --}}

            </tbody>
        </table>
        <script>
            function makeEditable(cell) {
                cell.contentEditable = true;
                cell.focus();

                cell.addEventListener('blur', function() {
                    cell.contentEditable = false;
                    const newValue = cell.innerText;
                    const itemId = cell.getAttribute('data-item-id');
                    const column = cell.getAttribute('data-column');
                    saveCellValueToServer(itemId, column, newValue);
                });
            }

            function saveCellValueToServer(itemId, column, newValue) {
                fetch(`/editDetailItem/${itemId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ column, newValue }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.log('Произошла ошибка', error);
                    });
            }
        </script>
    </div>
@endsection
