$(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        let success = urlParams.get('success');
        let message = success ? 'Статус успешно обновлен' : 'Ошибка при обновлении статуса';
        let alertClass = success ? 'alert-success' : 'alert-danger';

        let $alert = $(` 
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert"
            style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
            </div>
        `);

         $('body').append($alert);
         $alert.hide().fadeIn(300);

         setTimeout(function () {
             $alert.fadeOut(500, function () {
                 $(this).remove();
             });
         }, 3000);

         urlParams.delete('success');
         let newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
         window.history.pushState({}, '', newUrl);

    }
});