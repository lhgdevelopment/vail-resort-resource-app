@extends('layouts.admin')

@section('content')

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">SMTP Settings</h5>
            <form action="{{ route('smtp.update') }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="form-group pt-2">
                    <label for="mail_host">Mail Host</label>
                    <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ $settings->mail_host ?? '' }}" required>
                </div>
        
                <div class="form-group pt-2">
                    <label for="mail_port">Mail Port</label>
                    <input type="text" class="form-control" id="mail_port" name="mail_port" value="{{ $settings->mail_port ?? '' }}" required>
                </div>
        
                <div class="form-group pt-2">
                    <label for="mail_username">Mail Username</label>
                    <input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ $settings->mail_username ?? '' }}" required>
                </div>

                <div class="form-group pt-2">
                    <label for="mail_from">Mail From</label>
                    <input type="email" class="form-control" id="mail_from" name="mail_from" value="{{ $settings->mail_from ?? '' }}" required>
                </div>
        
                <div class="form-group pt-2">
                    <label for="mail_password">Mail Password</label>
                    <input type="password" class="form-control" id="mail_password" name="mail_password" value="{{ $settings->mail_password ?? '' }}" required>
                </div>
        
                <div class="form-group pt-2">
                    <label for="mail_encryption">Mail Encryption</label>
                    <input type="text" class="form-control" id="mail_encryption" name="mail_encryption" value="{{ $settings->mail_encryption ?? '' }}" required>
                </div>
        
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
