const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    timer: 1000,
    timerProgressBar: true,
    showConfirmButton: false,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Toast.stopTimer);
        toast.addEventListener("mouseleave", Toast.resumeTimer);
    },
});

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

    async getData(data) {
        const result = await $.ajax({
            url: data.url ,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                return response.data;
            },
            error: (error) => {
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    timer: 2000,
                });
            },
        });

        return result;
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
                Toast.fire({
                    icon: "success",
                    title: response.message,
                }).then((result) => {
                    $(".modal").modal("hide");
                });
            },
            error: (error) => {
                if (data.validation == true) {
                    $(".form-text-validation").text(" ");
                    for (const [key, value] of Object.entries(
                        error.responseJSON.data
                    )) {
                        $(`small.${key}`).text(value);
                    }
                }
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    timer: 2000,
                });
            },
        });
    }

    async edit(data) {
        const result = await $.ajax({
            url: data.url + "/" + data.data,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                return response.data;
            },
            error: (error) => {
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    timer: 2000,
                });
            },
        });

        return result;
    }

    async delete(data) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: data.url + "/" + data.data,
                    headers: {
                        "X-CSRF-TOKEN": csrftoken,
                    },
                    success: (response) => {
                        Toast.fire({
                            icon: "success",
                            title: response.message,
                        });
                        this.reload(data.table);
                    },
                    error: (error) => {
                        Toast.fire({
                            icon: "error",
                            title: error.responseJSON.message,
                            timer: 2000,
                        });
                    },
                });
            }
        });
    }

    reload(data) {
        if (data) {
            let table = $(`#${data}`).DataTable();
            table.ajax.reload(null, true);
        }
    }
}
