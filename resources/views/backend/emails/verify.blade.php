<p>Hello {{ $user->name }},</p>
<p>Please verify your email by clicking the link below:</p>
<a href="{{ route('verify.email', $user->email_verification_token) }}">Verify Email</a>
