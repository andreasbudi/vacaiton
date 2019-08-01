<p><b>Your Leave Request detail :</b></p>
<p>Date          : From {{ $dataClient['from']}} to {{ $dataClient['to']}}</p>
<p>Duration      : {{ $dataClient['duration']}} days</p>
<p>Reason        : {{ $dataClient['reason']}}</p>
<p>Status        : Waiting for approval</p>
<p>Leave balance : {{ $dataClient['leaves_available']}} days</p>
<br>
<p>You can edit or cancel your request by <a class="btn btn-sm btn-success" href="http://localhost:8000/home">clicking here</a></p>
