$(document).ready(function() {
    const sessionToken = localStorage.getItem('sessionToken');
    const userId = localStorage.getItem('userId');
    
    if(!sessionToken || !userId) {
        window.location.href = 'login.html';
        return;
    }
    
    $.ajax({
        url: 'php/get_profile.php',
        type: 'POST',
        dataType: 'json',
        data: {
            sessionToken: sessionToken,
            userId: userId
        },
        success: function(response) {
            if(response.success) {
                $('#username').val(response.data.username);
                $('#email').val(response.data.email);
                $('#age').val(response.data.age || '');
                $('#dob').val(response.data.dob || '');
                $('#contact').val(response.data.contact || '');
            } else {
                localStorage.clear();
                window.location.href = 'login.html';
            }
        },
        error: function() {
            localStorage.clear();
            window.location.href = 'login.html';
        }
    });
    
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        
        const age = $('#age').val();
        const dob = $('#dob').val();
        const contact = $('#contact').val();
        
        $.ajax({
            url: 'php/update_profile.php',
            type: 'POST',
            dataType: 'json',
            data: {
                sessionToken: sessionToken,
                userId: userId,
                age: age,
                dob: dob,
                contact: contact
            },
            success: function(response) {
                if(response.success) {
                    $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                } else {
                    $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });
    
    $('#logoutBtn').on('click', function() {
        $.ajax({
            url: 'php/logout.php',
            type: 'POST',
            dataType: 'json',
            data: {
                sessionToken: sessionToken,
                userId: userId
            },
            success: function() {
                localStorage.clear();
                window.location.href = 'login.html';
            },
            error: function() {
                localStorage.clear();
                window.location.href = 'login.html';
            }
        });
    });
});
