<tr>
    <th scope="row">
        <input type="checkbox" name="selectfiles[]" value="{{ basename($file) }}" class="select-item">
    </th>
    <td><a target="_blank" href="{{ Storage::disk('admin')->url($file) }}"><i class="fas fa-download fa-fw"></i></a></td>
    <td><a target="_blank" href="{{ Storage::disk('admin')->url($file) }}">{{ basename($file) }}</a></td>
    <td>{{ $filename->catalog->name }}</td>
    <td><button class="btn btn-light view-online" data-url="{{ Storage::disk('admin')->url($file) }}"><i class="far fa-eye fa-fw"></i></button></td>
</tr>