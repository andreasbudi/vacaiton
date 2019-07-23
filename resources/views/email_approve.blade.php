<p>Dear {{$data['name']}},</p>
<p>I have received your request to be excused from work from <b>{{ $data['from']}}</b> to <b>{{ $data['to']}}.</b></p>
<p></p>
<p>This notification serves as confirmation that your time off has been <b>approved</b>.</p>
<p></p>
<p>Sincerely,</p>
<br>
<p>{{$data['nameSpv']}}</p>
<p>{{$data['spv_department']}}</p>
<a class="btn btn-sm btn-success" value="send" href="http://localhost:8000/">http://localhost:8000/</a>

