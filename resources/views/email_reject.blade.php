<p>Dear {{ $data['name']}},</p>
<p>This letter is in response to your request for a leave of absence beginning <b>{{ $data['from']}}</b> through <b>{{ $data['to']}}</b> for {{ $data['reason']}}. Although we make every effort to accommodate employees with a need for time off, unfortunately, your leave request is not approved due to {{ $data['reject_message']}}.</p>
<p>If you feel that this decision is made in error or that extenuating circumstances warrant further review of your request, please feel free to contact me with more information surrounding your need for leave.</p>
<p></p>
<p>Sincerely,</p>
<br>
<p>{{$data['nameSpv']}}</p>
<p>{{$data['spv_department']}}</p>
<a class="btn btn-sm btn-success" value="send" href="http://localhost:8000/">http://localhost:8000/</a>

