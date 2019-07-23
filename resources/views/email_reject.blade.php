<p>Dear {{ $data['name']}},</p>
<p>This letter is in response to your request for a leave of absence beginning <b>{{ $data['from']}}</b> through <b>{{ $data['to']}}</b> for <b>{{ $data['reason']}}</b>.</p>
<p>Although we make every effort to accommodate employees with a need for time off, unfortunately, your leave request is not approved due to <b>{{ $data['reject_message']}}</b>.</p>
<p>Sincerely,</p>
<br>
<p>{{$data['nameSpv']}}</p>
<p>{{$data['spv_department']}}</p>
<a class="btn btn-sm btn-success" value="send" href="http://localhost:8000/">http://localhost:8000/</a>

