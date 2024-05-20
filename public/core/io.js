function show_alert(msg,status,icon) {
    $.notify({
        // options
        message: `<strong style="font-family: serif;">${msg}</strong>`,
        icon: `${icon} ?? fas fa-check-circle`,
    },{
        // settings
        element: 'body',
        type: `${status}`,
        allow_dismiss: true,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 99999,
        delay: 500,
        timer: 800,
        animate: {
            enter: 'animated lightSpeedIn',
            exit: 'animated lightSpeedOut'
        },
        icon_type: 'class',
    });
    $('.alert').css('width', 400)
    $('.alert button').css('border', 0).addClass(`bg-${status}`)
}

function show_alert_success(msg) {
    show_alert(msg, 'success')
}

function show_alert_error(msg) {
    show_alert(msg, 'danger', 'fas fa-window-close')
}

function show_alert_warn(msg) {
    show_alert(msg, 'warning', 'fas fa-exclamation-triangle')
}

function show_alert_info(msg) {
    show_alert(msg, 'info', 'fas fa-exclamation-circle')
}

// Function to submit a form to a specified URL using an HTTP POST request
function _POST_FORM(formId, url, options = {}) {
    // Destructuring assignment to extract properties from the options object
    const { callback, type = 'json', globalCallback = true } = options;


    let formData = new FormData();
    // Use serializeArray to convert form elements to an array of objects
    // with name and value properties. If formId is not provided, use an empty array
    const data = formId ? $(formId).serializeArray() : [];

    // Add a _token object to the data array if a _token meta tag is present in the document
    const _token = $('meta[name=_token]').attr('content');
    if (_token) {
        data.push({ name: '_token', value: _token });
    }

    // Add a token object to the data array if a .token element is present in the form
    const token = $('.token').val();
    if (token) {
        data.push({ name: 'token', value: token });
    }

    data.forEach((e) => {
        formData.append(e.name, e.value);
    })


    let dom_tinymce = $('.tinymce').length;
    if(dom_tinymce){
        let length_tinymce = tinymce.activeEditor.getContent().length
        if(length_tinymce) {
            $('.tinymce').each(function() {
                let editorId = $(this).attr('id');
                let name =  $(this).attr('name');
                let editorContent = tinymce.get(editorId).getContent({format: 'raw'});
                data.forEach((e, k) => {
                    if (e.name === name) {
                        formData.append(e.name, editorContent);
                    }
                })
            });
        }
    }

    let object = {};
    formData.forEach(function(value, key){
        if (key.endsWith('[]')) {
            const name = key.slice(0, -2);
            if (!object[name]) {
                object[name] = [];
            }
            object[name].push(value);
        } else {
            object[key] = value;
        }
    });

    let value = JSON.stringify(object);
    value = encoding(value)


    formData = new FormData();
    let dom_files = $(formId).find('input[type=file]')
    if (dom_files.length) {
        dom_files.each(function (k, e) {
            let files = $(e).prop('files')
            let name = $(e).attr("name");
            if (files.length > 1) {
                name = name + '[]'
            }
            for (let i = 0; i < files.length; i++) {
                let file = files[i]
                formData.append(name, file)
            }
        })
    }
    formData.append('fields', value)

    // Make an AJAX request to the specified URL using the data array as the payload
    return $.ajax({
        url,
        headers: {
            'X-CSRF-TOKEN': _token,
        },
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        enctype: "multipart/form-data",
        dataType: type,
    })
        // If the request is successful, check the globalCallback flag and
        // execute the global callback function if necessary
        .then((res) => {
            if (callback) {
                // Create a new function from the string passed to options.callback and execute it
                return callback(res)
            }
            if (globalCallback) {
                // Create a new function from the string passed to __callback and execute it
                return __callback(res);
            }
            // Return the response data if globalCallback is false
            return res;
        })
        // If the request is unsuccessful, handle the error
        .catch((xhr) => {
            let errors;
            // Check for an errors property in the response
            if (typeof xhr.responseJSON.errors !== 'undefined') {
                errors = xhr.responseJSON.errors;
            }
            // If there is no errors property, check for a msg property
            else if (xhr.responseJSON.msg) {
                errors = [xhr.responseJSON.msg];
            }
            // If neither an errors nor a msg property is present, use a default error message
            else {
                errors = ['Có lỗi xẩy ra trong quá trình thực hiện thao tác. Vui lòng liên hệ quản trị viên để biết thêm thông tin.'];
            }
            // Display the errors using the displayErrors function
            displayErrors(errors);
        });
}

// Function to display an array of error messages
function displayErrors(errors) {
    // Iterate through the errors array and display each message using show_alert_error
    $.map(errors,  function( val) {
        return show_alert_error(val[0]);
    })
}

function encoding(message) {
    let public_key = {e:5 , n: 10086119}
    return encrypt(message, public_key);
}



function _GET_URL(url, options = {}) {
    // Set default values for options if they are not provided
    const { type = 'GET', dataType = 'json', callback } = options;
    $.ajax({
        url,
        type,
        dataType,
        success(res) {
            // Check for a callback function and execute it if present
            if (callback) {
                // Create a new function from the string passed to options.callback and execute it
                callback(res)
            } else {
                __callback(res);
            }
        },
        error(xhr) {
            const res = xhr.responseJSON;
            try {
                show_alert_error(res);
            } catch (e) {
                show_alert_error(e);
            }
            // Check for a callback function and execute it if present
            if (callback) {
                // Create a new function from the string passed to options.callback and execute it
                callback(res)
            } else {
                __callback(res);
            }
        },
    });
    return false;
}


function __callback(res) {
    const { status, msg} = res;
    // Display a success or error message based on the value of the status property
     status === 200 ? show_alert_success(msg) : show_alert_error(msg);
    // Redirect the user to the specified URL if a redirect property is present in the result object
    if (typeof res.result.redirect !== 'undefined') {
        location.replace(res.result.redirect);
    }
    if(typeof res.result.reload !== 'undefined') {
        location.reload()
    }
    return true;
}

function INIT_SELECT2(select_id = '.select-2', dropdownParent = false){
    if ($(select_id).length) {
        let option = {
            allowClear: true,
            placeholder: 'Lựa chọn thông tin',
        }
        if (dropdownParent) {
            option = {...option, dropdownParent: $(dropdownParent)}
        }
        $(select_id).select2(option)
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    }
}

function INIT_TINYMCE(readonly = false,element = 'tinymce', height, _tool_bar_small) {
    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/admin/upload');
        xhr.setRequestHeader("X-CSRF-Token", jQuery('meta[name=_token]').attr("content"));

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({message: 'HTTP Error: ' + xhr.status, remove: true});
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.result.media.url != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.result.media.url);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    tinymce.init({
        selector: '.' + element,
        extended_valid_elements: 'figcaption[class|id|title]',
        readonly: readonly,
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help | image',
        urlconverter_callback: function (url, node, on_save, name) {
            return url;
        },
        entity_encoding: "raw",
        menubar: true,//không hiển thị menu bar,
        fix_list_elements: true,
        force_p_newlines: true,
        allow_conditional_comments: false,//Không chấp nhận comment html
        height: (typeof height !== 'undefined' ? height : 500),
        plugins: [
            'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        image_caption: true,
        image_advtab: true,
        image_description: true,
        image_title: true,
        images_upload_base_path: '/admin/upload',
        images_upload_credentials: true,
        images_upload_handler: example_image_upload_handler
    })
}

// Lặp qua các phần tử figcaption trong phần tử div
document.querySelectorAll('figcaption').forEach(function(figcaption) {
    // Loại bỏ thuộc tính contenteditable
    figcaption.removeAttribute('contenteditable');
});


function random_code() {
    return (Math.random() + 1).toString(36).substring(5);
}

function _SHOW_FORM_REMOTE(remote_link, target, addClass = 'modal-xl' , options = {}) {
    cursor_wait()
    if (target === undefined || target === '') {
        target = 'myModal';
    }
    $('.modal-backdrop').remove();
    $('#' + target).remove();
    let html = `<div class="modal fade" id="${target}" tabindex="-1" role="dialog" aria-labelledby="${target}Label" aria-hidden="true">
        <div class="modal-dialog ${addClass}">
            <div class="modal-content border-0">
                <div class="modal-body p-0 ">


                </div>
            </div>
        </div>
        </div>`
    jQuery('body').append(html);

    // = setUrlParameters(remote_link, 'time', new Date().getTime())
    $('#' + target).find('.modal-body').load(remote_link, function () {
        let myModalEl = document.querySelector('#' + target)
        let modal = bootstrap.Modal.getOrCreateInstance(myModalEl) // Returns a Bootstrap modal instance
        // $('.modal-dialog').addClass(addClass)
        modal.show()
        remove_cursor_wait()
        try {
            if (typeof options.callback !== "undefined") {
                return eval(options.callback());
            }
        }catch (e) {
            console.log(e)
        }
    });
    return false;
}


function cursor_wait() {
    $('html').addClass('wait');

    setTimeout(function() { remove_cursor_wait() }, 5000);
}

function remove_cursor_wait() {
    $('html').removeClass('wait');
}

function getUrlParameters(url, name) {
    let _url = new URL(url);
    return _url.searchParams.get(name);
}

function setUrlParameters(url, name, value) {
    let _url = new URL(url);
    _url.searchParams.set(name, value);
    return _url
}

function setUrlParametersHref(url, name, value) {
    let _url = new URL(url);
    _url.searchParams.set(name, value);
    return _url.href
}


function setMultiUrlParameters(url,data) {
    let _url = new URL(url);
    $.map(data, function(value,key) {
        _url.searchParams.append(key,value);
    })
    return _url
}

function deleted(id, link) {
    document.querySelector('.confirm-'+id).addEventListener('click', function () {
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa bản ghi này?',
            text: "Dữ liệu đã xóa thì không thể phục hồi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Chấp nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = link
                let token = $('.token').val();
                url = setUrlParameters(url, 'token', token);
                url = setUrlParameters(url, 'id', id);
                _GET_URL(url.href, {
                    callback: function (res) {
                        if (res.status === 200) {
                            Swal.fire(
                                'Đã xóa',
                                'Bản ghi này đã được xóa thành công!',
                                'success'
                            ).then(function () {
                                // Xử lý logic sau khi xóa thành công
                                location.reload();
                            })
                        } else {
                            return show_alert_error(res.msg);
                        }
                    }
                });

            }
        })
    })
}

$(function() {
    "use strict";
    $('.single-select').select2({
        width: '100%',
        maximumSelectionSize: 5,
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        width: '100%',
        maximumSelectionSize: 5,
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
});

function  INISINGLESELECT() {
    $('.single-select').select2({
        width: '100%',
        maximumSelectionSize: 5,
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
}



function INISELECT2() {
    $('.select2').select2({
        theme: 'classic',
        width: '100%',
        maximumSelectionSize: 5,
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
}

function INIDROPIFY() {
    $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': '',
            'remove':  'Remove',
            'error':   'Sorry, something went wrong.'
        }});
}

function getVideoId(url) {
    return /^https?\:\/\/(www\.)?youtu\.be/.test(url) ?
        url.replace(/^https?\:\/\/(www\.)?youtu\.be\/([\w-]{11}).*/, "$2") :
        url.replace(/.*\?v\=([\w-]{11}).*/, "$1");
}

function isValidURL(string) {
    if (typeof string !== 'string' || string.length === 0) {
        return false;
    }
    let res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    return (res !== null)
}

function LoadForm(dom = '#finder', url,option = {}) {
    let dom_finder = $(dom)
    _GET_URL(url, {callback: function (res) {
            if (res.success) {
                dom_finder.empty()
                let view = res.view
                if (typeof option.callback !== "undefined") {
                    return eval(option.callback(res));
                }
                return dom_finder.append(view)
            }
        }})
}

function show_logo(dom,target_id){
    if (dom.files && dom.files[0]) {
        let input = $(dom).clone()
        let reader = new FileReader();
        // set where you want to attach the preview
        reader.target_elem = $('#'+target_id);
        reader.onload = function (e) {
            // Attach the preview
            let id = dom.files[0].name
            id = id.replace(/[^0-9.]/g, "").replace( '.', '' );
            $(reader.target_elem).append(`<div id="${id}" >
                <a onclick="remove_file('${id}')"><i class="bx bx-x-circle float-end delete_icon"></i></a>
                <img class="img-fluid img-thumbnail rounded" width="100%" src="${e.target.result}"
                                                 alt="profile-image">
            </div>`)
            input.attr('name', 'images[]');
            $('#'+id).append(input)
        };
        reader.readAsDataURL(dom.files[0]);
    }
}

function remove_file(dom){
    $('#'+ dom).remove()
}

function SubtractQuantity() {
    let val = $('.qty-input').val()
    val = val - 1;
    if(val < 1) {
        val = 1
    }
    $('.qty-input').val(val)
}

function AddAmount(){
       let val = $('.qty-input').val()
       val = parseInt(val) + 1;
       if(val >= 9999) {
           val = 9999
       }
       $('.qty-input').val(val)
}

function replace(url){
   return location.replace(url);
}

function get_link_product(link = '') {
    let hostname = location.hostname;
    return 'https://' + hostname + '/product/' + link +'.html';
}

function show_img(link) {
    // let hostname = location.hostname;
    let hostname = location.href;
    return 'https://' + hostname + '/' + link;
}

function formatMoney(number) {
    let formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        minimumFractionDigits: 0
    });
    return formatter.format(number);
}

function convertMoneyToNumber(moneyString) {
    // Loại bỏ tất cả các ký tự không phải là số hoặc dấu thập phân
    return parseInt(moneyString.replace(/[,.₫]/g, ""));

}










