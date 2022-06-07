@if (count($archive))  
    <table class="table table-striped table-hover m-b-0">
        <thead>
            <tr>
                <th><span>№</span></th>
                <th><span>Name</span></th>
                <th><span>Department</span></th>
                <th><span>Text Message</span></th>
                <th><span>Status</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archive as $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->cadry->fullname}}</td>
                    <td>{{$item->cadry->department}}</td>
                    <td >{{$item->text_message}}</td>
                    <td>
                        <span class="badge badge-success text-dark">    {{$item->created_at->format('d-m-Y , H:i:s')}} </span>
                    </td>
                </tr>
                

            @endforeach
        </tbody>
    </table>
    {{$archive->withQueryString()->links()}}
@endif