<p>Thanks {{ $dataClient['name']}},</p>
<p>Your absence request is <b>waiting for approval.</b></p>
<p>Give us a few moments to make sure that we've got everything under control. You will receive another email from us soon.</p>
<p>If this request was made outside of our normal working hours, we may not be able to confirm it until we're open again.</p>
<br>
<p><b>Your request details :</b></p>
<p>From     : {{ $dataClient['from']}}</p>
<p>To       : {{ $dataClient['to']}}</p>
<p>Duration : {{ $dataClient['duration']}} days</p>
<p>Reason   : {{ $dataClient['reason']}}</p>
<br>
<p>Regards,</p>
<p>Admin</p>
