<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    @foreach($socials as $account)
        <button class="login-btn" data-account-id="{{ $account->id }}">{{ $account->account_name }}</button>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.login-btn').on('click', function() {
            const accountId = $(this).data('account-id');
            $.ajax({
                url: '{{ route("admin.social.automate.facebook.login", ":accountId") }}'.replace(':accountId', accountId),
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (data.success) {
                        alert('Facebook login successful.');
                    } else {
                        alert('Facebook login failed.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Facebook login failed.');
                }
            });
        });
    </script>
</body>
</html>
