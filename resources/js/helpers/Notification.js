class Notification {
    success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done!',
            timeout: 1000,
       }).show();
    }

    alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure?',
            timeout: 1000,
       }).show();
    }

    error(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Something went wrong!',
            timeout: 1000,
       }).show();
    }

    warning(){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Opps! Wrong Something',
            timeout: 1000,
       }).show();
    }

    image_validation(){
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Upload Image less then 1MB',
            timeout: 1000,
       }).show();
    }

    cart_success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Cart Add Successfully!',
            timeout: 1000,
       }).show();
    }

    cart_delete(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Deleted!',
            timeout: 1000,
       }).show();
    }
}

export default Notification = new Notification();