class Crud {
    get(data) {
        $(`#${data.table}`).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: data.url,
                // data: data.parm,
            },
            language: {
                search: "Search Data:",
                searchPlaceholder: "Search",
            },
            columns: data.colums,
        });
    }

    input(data) {
        $.ajax({
            type: "POST",
            url: data.url,
            data: data.data,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000,
                });
            },
            error: (error) => {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
        });
    }
}
