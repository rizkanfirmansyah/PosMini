class Auth {
    login(data) {
        $.ajax({
            type:'POST',
            url: '/api/v1/auth/login',
            data:data,
            processData:false,
            contentType:false,
            headers:{
                'X-CSRF-TOKEN' : csrftoken
            },
            success:response=>{
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result)=>{
                    location.href = '/dashboard';
                });
            },
            error:error => {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        })
    }
}
