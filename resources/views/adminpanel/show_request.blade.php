@foreach($fileGroups['Video'] as $file)
    <a href="{{ route('download', ['filename' => $file->filename]) }}">{{ $file->filename }}</a>
@endforeach
@foreach($fileGroups['Audio'] as $file)
    <a href="{{ route('download', ['filename' => $file->filename]) }}">{{ $file->filename }}</a>
@endforeach
@foreach($fileGroups['document'] as $file)
    <a href="{{ route('download', ['filename' => $file->filename]) }}">{{ $file->filename }}</a>
@endforeach
@foreach($fileGroups['photo'] as $file)
    <a href="{{ route('download', ['filename' => $file->filename]) }}">{{ $file->filename }}</a>
@endforeach