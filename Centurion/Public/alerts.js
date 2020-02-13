const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

if (typeof phpvars != null)
{
    if (typeof phpvars.alertFunc != null)
    {
        if (typeof window[phpvars.alertFunc] != null)
        {
            window[phpvars.alertFunc].apply(this, phpvars.alertFuncArgs);
        }
    }
}

function sweetAlertSuccess(message)
{
    Toast.fire({
        type: 'success',
        title: message
    });
}

function sweetAlertInfo(message)
{
    Toast.fire({
        type: 'info',
        title: message
    });
}

function sweetAlertError(message)
{
    Toast.fire({
        type: 'error',
        title: message
    });
}

function sweetAlertWarning(message)
{
    Toast.fire({
        type: 'warning',
        title: message
    });
}

function sweetAlertQuestion(message)
{
    Toast.fire({
        type: 'question',
        title: message
    });
}

function toastDefaultSuccess(message)
{
    toastr.success(message);
}

function toastDefaultError(message)
{
    toastr.error(message);
}

function toastDefaultInfo(message)
{
    toastr.info(message);
}

function toastDefaultWarning(message)
{
    toastr.warning(message);
}

