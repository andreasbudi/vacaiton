<p>Dear {{ $data['name']}},</p>
<p>It is my pleasure to welcome you to the {{ $data['department']}} department at Difinite Company. You have <b>{{ $data['leaves_available']}} leaves available</b> within a year, please use it wisely :)</p>
<p>This is your email <b>{{ $data['email']}}</b> and password <b>{{ $data['password']}}.</b></p>
<p>Please change your password immediately.</p>
<p>We’re looking forward to working with you.</p>
<br>
<p>Regards,</p>
<p>Admin</p>
<a class="btn btn-sm btn-success" value="send" href="http://localhost:8000/">http://localhost:8000/</a>

