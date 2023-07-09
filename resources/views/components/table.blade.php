@if (!isset($offcanvasId))
    @php
        $offcanvasId = '';
    @endphp
@endif
<div class="table-responsive text-nowrap">
    <table class="table table-bordered py-4" id="myTable">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                @if ($canDelete || $canEdit)
                    <th>actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr
                    class="
                @isset($row['active'])
                    @if (!$row['active']) table-active @endif
                @endisset
                ">
                    @foreach ($row as $cell)
                        @php
                            $lastActive = array_key_exists('active', $row);
                            // dd($last);
                        @endphp
                        @if ($lastActive)
                            @if ($cell != $loop->first && $cell != $loop->last)
                                <td>
                                    {!! $cell !!}
                                </td>
                            @endif
                        @else
                            @if ($cell != $loop->first)
                                <td>
                                    {!! $cell !!}
                                </td>
                            @endif
                        @endif
                    @endforeach

                    @if ($canDelete || $canEdit || $canShow)
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    @if ($canShow)
                                        <a href="{{ route($show, $row[0]) }}" class="dropdown-item"><i
                                                class="bx bx-show me-1"></i>
                                            Show
                                        </a>
                                    @endif
                                    @if ($canEdit)
                                        <button type="button" class="btn-edit dropdown-item" data-bs-toggle="offcanvas"
                                            data-bs-target="#{{ $offcanvasId }}" aria-controls="offcanvasEnd"
                                            data-id="{{ $row[0] }}"><i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </button>
                                    @endif
                                    @if ($canDelete)
                                        <form action="{{ route($delete, $row[0]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
